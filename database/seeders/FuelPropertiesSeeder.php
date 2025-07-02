<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuelPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // data berasal dari https://www.ipcc-nggip.iges.or.jp/public/2006gl/pdf/2_Volume2/V2_2_Ch2_Stationary_Combustion.pdf
        DB::table('fuel_properties')->insert([
            ['fuel_type' => 'Solar CN 48', 'unit' => 'liter', 'conversion_factor' => 0.00003647661, 'co2_factor' => 74100, 'ch4_factor' => 4, 'n2o_factor' => 0.6],
            ['fuel_type' => 'Solar CN 53', 'unit' => 'liter', 'conversion_factor' => 0.0000000378885, 'co2_factor' => 74100, 'ch4_factor' => 4, 'n2o_factor' => 0.6],
            ['fuel_type' => 'Solar CN 51', 'unit' => 'liter', 'conversion_factor' => 0.0000382184, 'co2_factor' => 74100, 'ch4_factor' => 4, 'n2o_factor' => 0.6],
            ['fuel_type' => 'Bensin RON 98', 'unit' => 'liter', 'conversion_factor' => 0.000033465, 'co2_factor' => 69300, 'ch4_factor' => 4, 'n2o_factor' => 0.6],
            ['fuel_type' => 'Bensin RON 92', 'unit' => 'liter', 'conversion_factor' => 0.00003278835, 'co2_factor' => 69300, 'ch4_factor' => 4, 'n2o_factor' => 0.6],
            ['fuel_type' => 'Bensin RON 90', 'unit' => 'liter', 'conversion_factor' => 0.00003260991, 'co2_factor' => 69300, 'ch4_factor' => 4, 'n2o_factor' => 0.6],
            ['fuel_type' => 'Avtur', 'unit' => 'liter', 'conversion_factor' => 0.00003473943, 'co2_factor' => 71000, 'ch4_factor' => 2, 'n2o_factor' => 0.6],
            ['fuel_type' => 'Minyak Tanah', 'unit' => 'liter', 'conversion_factor' => 0.0000343875, 'co2_factor' => 71000, 'ch4_factor' => 4, 'n2o_factor' => 0.6],
            ['fuel_type' => 'Minyak Diesel', 'unit' => 'liter', 'conversion_factor' => 0.000035702625, 'co2_factor' => 74100, 'ch4_factor' => 4, 'n2o_factor' => 0.6],
            ['fuel_type' => 'Minyak Bakar', 'unit' => 'liter', 'conversion_factor' => 0.000034569525, 'co2_factor' => 77400, 'ch4_factor' => 3, 'n2o_factor' => 0.6],
            ['fuel_type' => 'LPG', 'unit' => 'liter', 'conversion_factor' => 0.0000244436, 'co2_factor' => 63000, 'ch4_factor' => 11, 'n2o_factor' => 1],
            ['fuel_type' => 'LGV', 'unit' => 'liter', 'conversion_factor' => 0.00002522805, 'co2_factor' => 63000, 'ch4_factor' => 11, 'n2o_factor' => 1],
            ['fuel_type' => 'Natural Gas', 'unit' => 'liter', 'conversion_factor' => 0.0000085918, 'co2_factor' => 56100, 'ch4_factor' => 1, 'n2o_factor' => 0.1],
            ['fuel_type' => 'LNG', 'unit' => 'liter', 'conversion_factor' => 0.0000216752, 'co2_factor' => 56100, 'ch4_factor' => 1, 'n2o_factor' => 0.1],
            ['fuel_type' => 'BB Rendah', 'unit' => 'ton', 'conversion_factor' => 0.00001406, 'co2_factor' => 96000, 'ch4_factor' => 1, 'n2o_factor' => 1.5],
            ['fuel_type' => 'BB Sedang', 'unit' => 'ton', 'conversion_factor' => 0.00002244, 'co2_factor' => 96500, 'ch4_factor' => 1, 'n2o_factor' => 1.5],
            ['fuel_type' => 'BB Tinggi', 'unit' => 'ton', 'conversion_factor' => 0.00003374, 'co2_factor' => 97000, 'ch4_factor' => 1, 'n2o_factor' => 1.5],
            ['fuel_type' => 'Batubara Antrasit', 'unit' => 'ton', 'conversion_factor' => 0.024, 'co2_factor' => 98300, 'ch4_factor' => 1, 'n2o_factor' => 1.5],
            ['fuel_type' => 'Batubara Sub-bituminous', 'unit' => 'ton', 'conversion_factor' => 0.024, 'co2_factor' => 96100, 'ch4_factor' => 1, 'n2o_factor' => 1.5],
        ]);
    }
}
