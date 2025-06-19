<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Report;
use App\Models\FuelCombustionActivities;
use App\Models\FugitiveEmission;
use App\Models\SensorEntry;
use App\Models\Perusahaan;
use Carbon\Carbon;

class GenerateGHGReport extends Command
{
    protected $signature = 'app:generate-ghg-report {--periode=} {--perusahaan_id=}';
    protected $description = 'Generate GHG report from activities and sensors';

    public function handle()
    {
        $periode = $this->option('periode') ?? Carbon::now()->format('Y-m');
        $perusahaanId = $this->option('perusahaan_id');
        $periodType = strlen($periode) === 7 ? 'bulanan' : 'harian';

        // Ambil data aktivitas & sensor sesuai periode & perusahaan
        $activities = FuelCombustionActivities::where('period', 'like', "$periode%")
            ->when($perusahaanId, function($q) use ($perusahaanId) {
                $q->whereHas('sumber_emisi', function($q2) use ($perusahaanId) {
                    $q2->where('perusahaan_id', $perusahaanId);
                });
            })
            ->get();

        $fugitives = FugitiveEmission::where('period', 'like', "$periode%")
            ->when($perusahaanId, function($q) use ($perusahaanId) {
                $q->where('perusahaan_id', $perusahaanId);
            })
            ->get();

        $sensors = SensorEntry::whereMonth('inserted_at', Carbon::parse($periode)->month)
                      ->whereYear('inserted_at', Carbon::parse($periode)->year);
        if ($perusahaanId) {
            $sensors = $sensors->where('perusahaan_id', $perusahaanId);
        }
        $sensors = $sensors->get();

        // Agregasi data
        $total_co2 = $activities->sum(fn($a) => json_decode($a->total_emission_ton)->co2 ?? 0)
                    + $fugitives->sum('co2')
                    + $sensors->sum('co2');
        $total_ch4 = $activities->sum(fn($a) => json_decode($a->total_emission_ton)->ch4 ?? 0)
                    + $fugitives->sum('ch4')
                    + $sensors->sum('ch4');
        $total_n2o = $activities->sum(fn($a) => json_decode($a->total_emission_ton)->n2o ?? 0)
                    + $fugitives->sum('n2o')
                    + $sensors->sum('n2o');

        $count = $activities->count() + $fugitives->count() + $sensors->count();
        $avg_co2 = $count ? $total_co2 / $count : 0;
        $avg_ch4 = $count ? $total_ch4 / $count : 0;
        $avg_n2o = $count ? $total_n2o / $count : 0;

        // Simpan ke tabel report
        Report::updateOrCreate(
            [
                'period_date' => $periode . '-01',
                'perusahaan_id' => $perusahaanId,
                'period_type' => $periodType
            ],
            [
                'total_co2' => $total_co2,
                'total_ch4' => $total_ch4,
                'total_n2o' => $total_n2o,
                'avg_co2' => $avg_co2,
                'avg_ch4' => $avg_ch4,
                'avg_n2o' => $avg_n2o,
            ]
        );

        $this->info("Laporan GHG untuk periode $periode berhasil dibuat/diupdate.");
    }
}