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
                    'sensor_id' => "sensor-001",
                    'sensor_type' => "CH4",
                    'timestamp' => now(),
                    'latitude' => -6.9178,
                    'longitude' => 107.6194,
                    // 'installation_date' => now(),
                ],
                [
                    'sensor_id' => "sensor-002",
                    'sensor_type' => "CO2",
                    'timestamp' => now(),
                    'latitude' => -6.9172,
                    'longitude' => 107.6189,
                    // 'installation_date' => now(),
                ],
                [
                    'sensor_id' => "sensor-003",
                    'sensor_type' => "CO2",
                    'timestamp' => now(),
                    'latitude' => -6.9180,
                    'longitude' => 107.6196,
                    // 'installation_date' => now(),
                ],
                [
                    'sensor_id' => "sensor-004",
                    'sensor_type' => "CH4",
                    'timestamp' => now(),
                    'latitude' => -6.9176,
                    'longitude' => 107.6187,
                    // 'installation_date' => now(),
                ],
                [
                    'sensor_id' => "sensor-005",
                    'latitude' => -6.9179,
                    'sensor_type' => "CH4",
                    'timestamp' => now(),
                    'longitude' => 107.6193,
                    // 'installation_date' => now(),
                ]
            ]
        );
    }
}
