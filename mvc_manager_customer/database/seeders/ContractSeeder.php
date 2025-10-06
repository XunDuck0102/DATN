<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/contracts.csv');
        $csvData = array_map('str_getcsv', file($path));
        $contracts = [];
        foreach ($csvData as $row) {
            $contracts[] = [
                'id' => $row[0],
                'code' => $row[1],
                'name' => $row[2],
                'customer_id' => $row[3],
                'staff_id' => $row[4],
                'content' => $row[5],
                'status' => $row[6],
                'signed_date' => $row[7],
                'end_date' => $row[8],
                'file' => '',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('contracts')->insert($contracts);
    }
}
