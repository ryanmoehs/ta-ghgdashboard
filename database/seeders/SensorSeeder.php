<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sensors')->insert(
            [
                [
                    'sensor_name' => "sensor-001",
                    'field' => "field7",
                    'parameter_name' => "CO2",
                    'unit' => "ppm",
                    'latitude' => -6.9178,
                    'longitude' => 107.6194,
                    // 'installation_date' => now(),
                ],
                [
                    'sensor_name' => "sensor-002",
                    'field' => "field7",
                    'parameter_name' => "CO2",
                    'unit' => "ppm",
                    'latitude' => -6.9172,
                    'longitude' => 107.6189,
                    // 'installation_date' => now(),
                ],
                [
                    'sensor_name' => "sensor-003",
                    'parameter_name' => "CO2",
                    'field' => "field7",
                    'unit' => "ppm",
                    'latitude' => -6.9180,
                    'longitude' => 107.6196,
                    // 'installation_date' => now(),
                ],
                [
                    'sensor_name' => "sensor-004",
                    'parameter_name' => "CH4",
                    'field' => "field8",
                    'unit' => "ppm",
                    'latitude' => -6.9176,
                    'longitude' => 107.6187,
                    // 'installation_date' => now(),
                ],
                [
                    'sensor_name' => "sensor-005",
                    'parameter_name' => "CH4",
                    'field' => "field8",
                    'unit' => "ppm",
                    'latitude' => -6.9179,
                    'longitude' => 107.6193,
                    // 'installation_date' => now(),
                ]
            ]
        );
    }
}
