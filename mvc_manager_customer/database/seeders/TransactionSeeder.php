<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/transactions.csv');
        $csvData = array_map('str_getcsv', file($path));
        $transactions = [];
        foreach ($csvData as $row) {
            $transactions[] = [
                'id' => $row[0],
                'code' => $row[1],
                'staff_id' => $row[2],
                'contract_id' => $row[3],
                'transaction_date' => $row[4],
                'content' => $row[5],
                'amount' => $row[6],
                'name' => $row[7],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('transactions')->insert($transactions);
    }
}
