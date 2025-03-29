<?php
namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Illuminate\Support\Facades\Hash; // Import Hash

class ExcelImport implements ToArray
{
    public $data = [];

    public function array(array $rows)
    {
        // Skip the header row
        array_shift($rows);

        // Store data for later use
        foreach ($rows as $row) {
            $this->data[] = [
                'name' => $row[0] ?? null,
                'email' => $row[1] ?? null,
                'password' => isset($row[2]) ? Hash::make($row[2]) : Hash::make('password123'), // Hash password
                'realm_id' => $row[3] ?? 1,  
                'organization_id' => $row[4] ?? 1,
            ];
        }
    }
}
