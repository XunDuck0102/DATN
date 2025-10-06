<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/customers.csv');
        $csvData = array_map('str_getcsv', file($path));
        $customers = [];
        foreach ($csvData as $row) {
            $customers[] = [
                'id' => $row[0],
                'code' => $row[1],
                'name' => $row[2],
                'identity_number' => $row[3],
                'identity_issued_date' => $row[4],
                'identity_issued_place' => $row[5],
                'tax_code' => $row[6],
                'phone' => $row[7],
                'email' => $row[8],
                'address' => $row[9],
                'franchise_start_date' => $row[10],
                'status' => $row[11],
                'store_photo' => $row[12],
                'bank_account' => $row[13],
                'bank_name' => $row[14],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('customers')->insert($customers);
    }
}
