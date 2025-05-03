<?php
namespace App\Jobs;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Services\MasterAuthService;


class SyncLdapUsers implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $ldapDetails;

    public function __construct(array $ldapDetails)
    {
        $this->ldapDetails = $ldapDetails;
    }

    public function handle()
    {
        set_time_limit(0); // Safe for long LDAP sync jobs
        Log::info('Job started at: ' . now());
        
        
        try {
            $org = Organization::findOrFail($this->ldapDetails['organization_id']);

            $authService = new MasterAuthService();
            $response = $authService->sendLdapDetails([
                'ldap_id' => $this->ldapDetails['ldap_id'],
                'ldap_password' => $this->ldapDetails['ldap_password'],
                'domain_name' => $this->ldapDetails['domain_name'],
                'connection_url' => $this->ldapDetails['connection_url'],
                'users_dn' => $this->ldapDetails['users_dn']
            ]);
            

            if (
                !is_array($response) ||
                !isset($response['status_code']) ||
                $response['status_code'] !== 200 ||
                !isset($response['response']['data'])
            ) {
                Log::error('LDAP Sync failed: Invalid response.', ['response' => $response]);
                return;
            }

            $ldapUsers = $response['response']['data'];
            $counter = 1;

            foreach ($ldapUsers as $ldapUser) {
                $username = $ldapUser['username'] ?? 'user' . $counter;
                $email = $ldapUser['email'] ?? $username . '@example.com';
                $fname = $ldapUser['firstName'] ?? 'First' . $counter;
                $lname = $ldapUser['lastName'] ?? 'Last' . $counter;

                User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name' => $username,
                        'email' => $email,
                        'fname' => $fname,
                        'lname' => $lname,
                        'realm' => $org->organization_name,
                        'organization_id' => $org->id,
                        'password' => Hash::make('1234')
                    ]
                );

                $counter++;
            }

            Log::info('LDAP Users successfully synced.', ['org_id' => $org->id]);

        } catch (\Exception $e) {
            Log::error("LDAP Sync Job Error: " . $e->getMessage(), ['details' => $this->ldapDetails]);
        }
        Log::info('Job ended at: ' . now());
    }
}
