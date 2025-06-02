<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuelPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fuel_properties')->insert([
                [
                    'fuel_type' => 'Solar CN48',
                    'unit' => 'liter',
                    'conversion_factor' => 0.0000386,
                    'co2_factor' => 74100,
                    'ch4_factor' => 3,
                    'n2o_factor' => 0.6
                ],
                [
                    'fuel_type' => 'Batubara Antrasit',
                    'unit' => 'ton',
                    'conversion_factor' => 0.024,
                    'co2_factor' => 98300,
                    'ch4_factor' => 1,
                    'n2o_factor' => 1.5
                ],
                [
                    'fuel_type' => 'Batubara Sub-bituminous',
                    'unit' => 'ton',
                    'conversion_factor' => 0.024,
                    'co2_factor' => 96100,
                    'ch4_factor' => 1,
                    'n2o_factor' => 1.5
                ]
            ]
            );
        }
}
