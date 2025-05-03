<?php

namespace App\Jobs;

use App\Services\MasterAuthService;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\Organization;
use App\Models\UserImportBatch;

class CreateUserInSSO implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected object $userData;
    protected int $batchId;

    public function __construct(object $userData, int $batchId)
    {
        $this->userData = $userData;
        $this->batchId = $batchId;
    }

    public function handle(MasterAuthService $authService)
    {
        try {
            Log::info('Entered CreateUserInSSO job', ['userData' => $this->userData, 'batch_id' => $this->batchId]);

            $batch = UserImportBatch::find($this->batchId);
            if (!$batch) {
                Log::warning("Batch not found", ['batch_id' => $this->batchId]);
                return;
            }

            if (
                empty($this->userData->name) ||
                empty($this->userData->email) ||
                empty($this->userData->organization_id) ||
                !is_numeric($this->userData->organization_id)
            ) {
                Log::error('Invalid user data', ['data' => $this->userData]);
                $batch->increment('failed');
                return;
            }

            $org = Organization::find($this->userData->organization_id);
            if (!$org) {
                Log::warning("Organization not found", ['org_id' => $this->userData->organization_id]);
                $batch->increment('failed');
                return;
            }

            // 🔁 Retry logic starts here
            $maxAttempts = 3;
            $attempt = 0;
            $success = false;

            while ($attempt < $maxAttempts && !$success) {
                $attempt++;
                $sendResult = $authService->createUser($this->userData);

                if ($sendResult === true) {
                    $success = true;
                } else {
                    Log::warning("SSO creation attempt {$attempt} failed", ['email' => $this->userData->email]);
                    sleep(2); // Optional delay between retries
                }
            }
            // 🔁 Retry logic ends here

            if ($success) {
                User::create([
                    'name' => $this->userData->name,
                    'fname' => $this->userData->fname ?? '',
                    'lname' => $this->userData->lname ?? '',
                    'email' => $this->userData->email,
                    'password' => Hash::make($this->userData->org_password),
                    'organization_id' => $this->userData->organization_id,
                    'realm' => $org->realm,
                    'email_verified_at' => now(),
                ]);

                $batch->increment('completed');
            } else {
                Log::error("SSO creation failed after {$maxAttempts} attempts", ['email' => $this->userData->email]);
                // $batch->increment('failed');
                throw new \Exception("SSO creation failed for {$this->userData->email}");
            }

            $batch = $batch->fresh(); // Refresh counts
            Log::info("Total processed", ['completed' => $batch->completed, 'failed' => $batch->failed, 'total' => $batch->total]);

            if (($batch->completed + $batch->failed) >= $batch->total) {
                $batch->update(['status' => 'completed']);
            }

        } catch (\Exception $e) {
            Log::error("Job error for {$this->userData->email}: " . $e->getMessage());

            $batch = UserImportBatch::find($this->batchId);
            if ($batch) {
                $batch->increment('failed');
                $batch = $batch->fresh();

                if (($batch->completed + $batch->failed) >= $batch->total) {
                    $batch->update(['status' => 'completed']);
                }
            }
        }
    }
}
