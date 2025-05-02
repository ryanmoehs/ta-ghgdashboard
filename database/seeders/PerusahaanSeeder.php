<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('perusahaans')->insert(

            [
                'nama' => "PT Telkom Indonesia",
                'alamat' => "Jl. Jend. Sudirman No. 1",
                'provinsi' => "Jawa Barat",
                'kab_kota' => "Bandung",
                'kecamatan' => "Bandung Wetan",
                'kelurahan' => "Citarum",
                'no_telp' => "022-1234567",
                'kode_pos' => "40115",
                'penanggung_jawab' => "John Doe",
                'no_hp' => "08123456789",
                'jabatan' => "Manager",
                'email' => 'johndoe@telkom.com'
            ]
            );
    }
}
