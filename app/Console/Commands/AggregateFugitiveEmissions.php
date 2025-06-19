<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sensor;
use App\Models\SensorEntry;
use App\Models\FugitiveEmission;
use Carbon\Carbon;

class AggregateFugitiveEmissions extends Command
{
    protected $signature = 'fugitive:aggregate-daily';
    protected $description = 'Agregasi harian CH4 & CO2 dari SensorEntry berdasarkan sensor yang valid.';

    public function handle()
    {
        $today = Carbon::today();

        // Ambil semua sensor CH4 dan CO2 yang valid
        $sensors = Sensor::whereIn('parameter_name', ['CH4', 'CO2'])->get();

        foreach ($sensors as $sensor) {
            $field = strtolower($sensor->field); // e.g. "field7"
            $parameter = strtolower($sensor->parameter_name); // e.g. "ch4"

            // Ambil entri sensor data dari Aiven
            $entries = SensorEntry::whereDate('inserted_at', $today)->get();

            if (! $entries->isEmpty() && $entries->first()->getAttributes()[$field] !== null) {
                $total = $entries->sum($field);
                $ton = $this->convertToTon($total, $parameter);

                $emission = FugitiveEmission::firstOrNew([
                    'source_name' => $sensor->sensor_name,
                    'period' => $today,
                ]);

                $emission->company_id = $sensor->company_id ?? null;
                $emission->emission_factor = 1;
                $emission->production_amount = null;

                if ($parameter === 'ch4') {
                    $emission->ch4_emission_ton = $ton;
                    $emission->co2e_emission_ton = $ton * 28;
                } else if ($parameter === 'co2') {
                    $emission->co2_emission_ton = $ton;
                }

                $emission->save();
            }
        }

        $this->info('Validasi & agregasi fugitive emissions selesai.');
    }

    private function convertToTon($value, $gas)
    {
        return match ($gas) {
            'ch4' => $value * 0.0000016,
            'co2' => $value * 0.000002,
            default => 0,
        };
    }
}
