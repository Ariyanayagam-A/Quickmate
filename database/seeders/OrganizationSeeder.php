<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationSeeder extends Seeder
{
    public function run()
    {
        DB::table('organization')->insert([
            [
                'name' => 'Tech Corp',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business Ltd',
                'is_active' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
