<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/users.csv');
        $csvData = array_map('str_getcsv', file($path));
        $users = [];
        foreach ($csvData as $row) {
            $users[] = [
                'id' => $row[0],
                'name' => $row[1],
                'email' => $row[2],
                'phone' => $row[3],
                'gender' => $row[4],
                'dob' => $row[5],
                'address' => $row[6],
                'role' => $row[7],
                'password' => bcrypt(1),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('users')->insert($users);
    }
}
