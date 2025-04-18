<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;

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
                'fname' => $row[1] ?? null,
                'lname' => $row[2] ?? null,
                'email' => $row[3] ?? null,
                'password' => $row[4] ?? null, // Don't hash here, hash in controller
            ];
        }
    }
}
