<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'name' => 'Admin 1',
                'email' => 'user1@email.com',
                'username' => 'admin1',
                'no_hp' => '081234567890',
                'role' => 'admin',
                'password' => Hash::make('admin1pass')
            ],
            // Manager
            [
                'name' => 'PIC 1',
                'email' => 'pic1@email.com',
                'username' => 'pic1',
                'no_hp' => '081234567891',
                'role' => 'pic',
                'password' => Hash::make('pic1pass')
            ]
        ]);
    }
}
