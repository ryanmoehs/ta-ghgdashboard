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
            // Manager
            [
                'name' => 'Company 1',
                'email' => 'company1@email.com',
                'username' => 'comp1',
                'no_hp' => '081234567891',
                'role' => 'induk_perusahaan',
                'perusahaan_id' => 1,
                'password' => Hash::make('comp1pass')
            ],
            // [
            //     'name' => 'Teknisi 1',
            //     'username' => 'tek1',
            //     'role' => 'teknisi',
            //     'email' => 'teknisi1@email.com',
            //     'no_hp' => '081234567892',
            //     'perusahaan_id' => 0,
            //     'password' => Hash::make('tek1pass')
            // ]
        ]);
    }
}
