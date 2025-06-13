<?php

namespace App\Console\Commands;

use App\Models\FuelCombustionActivities;
use App\Models\SumberEmisi;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateFuelCombustionActivity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:generate-fuel-combustion-activity';

    // HANYA UNTUK TESTING
    protected $signature = 'app:generate-fuel-combustion-activity {--date=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hitung dan simpan aktivitas pembakaran dari sumber emisi';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateString = $this->option('date');
        // $period = Carbon::now()->startOfMonth()->toDateString();
        $period = $dateString ? Carbon::parse($dateString) : Carbon::now()->startOfMonth();
        $sumberList = SumberEmisi::with('fuel_properties')->get();

        DB::transaction(function () use ($sumberList, $period) {
            foreach ($sumberList as $sumber) {
                $fuel = $sumber->fuel_properties;
                if (!$fuel) continue;
    
                // 1. Hitung jumlah konsumsi bahan bakar
                $jumlah_konsumsi = $sumber->kapasitas_output * $sumber->durasi_pemakaian * $sumber->frekuensi_hari;
    
                // 2. Konversi ke TJ
                $energi_TJ = $jumlah_konsumsi * $fuel->conversion_factor;
    
                // 3. Hitung emisi
                $total_emisi = [
                    'co2' => round(($energi_TJ * $fuel->co2_factor) / 1000, 16),
                    'ch4' => round(($energi_TJ * $fuel->ch4_factor) / 1000, 16),
                    'n2o' => round(($energi_TJ * $fuel->n2o_factor) / 1000, 16),
                ];
    
                if ($jumlah_konsumsi == 0 || $energi_TJ == 0) {
                    $this->warn("Lewati sumber ID {$sumber->id}, energi = 0");
                    continue;
                }
                
    
                FuelCombustionActivities::updateOrInsert([
                    'sumber_emisi_id' => $sumber->id,
                    'period' => $period],
                    [
                    'source_name' => $sumber->sumber,
                    'fuel_type' => $fuel->fuel_type,
                    'quantity_used' => $jumlah_konsumsi,
                    'unit' => $sumber->unit,
                    'conversion_factor' => $fuel->conversion_factor,
                    'emission_factor' => json_encode([
                        'co2' => $fuel->co2_factor,
                        'ch4' => $fuel->ch4_factor,
                        'n2o' => $fuel->n2o_factor,
                    ]),
                    'total_emission_ton' => json_encode($total_emisi),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                
                $this->info("Memproses sumber ID: {$sumber->id}, nama: {$sumber->sumber}");
    
            }
        });
        $this->info('Jumlah sumber: ' . $sumberList->count());

        $this->info('Aktivitas pembakaran berhasil dihitung dan disimpan.');
    
    }
}
