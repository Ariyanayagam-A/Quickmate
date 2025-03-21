<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('realm_id', 255)->nullable()->after('id'); // Step 1: Add nullable column
        });

        // Step 2: Populate existing records with a unique random string
        foreach (DB::table('organizations')->get() as $organization) {
            DB::table('organizations')
                ->where('id', $organization->id)
                ->update(['realm_id' => Str::random(20)]); // Generates a 20-character unique string
        }

        // Step 3: Modify column to make it unique
        Schema::table('organizations', function (Blueprint $table) {
            $table->string('realm_id', 255)->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('organizations', function (Blueprint $table) {
            $table->dropColumn('realm_id');
        });
    }
};
