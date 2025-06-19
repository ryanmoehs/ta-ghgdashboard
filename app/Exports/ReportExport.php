<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $periodType;

    public function __construct($periodType = 'harian')
    {
        $this->periodType = $periodType;
    }

    public function collection()
    {
        $query = Report::with('perusahaan');
        if ($this->periodType === 'harian') {
            $query->whereDate('updated_at', now()->toDateString());
        } elseif ($this->periodType === 'bulanan') {
            $query->whereMonth('updated_at', now()->month)->whereYear('updated_at', now()->year);
        } elseif ($this->periodType === 'tahunan') {
            $query->whereYear('updated_at', now()->year);
        }
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Perusahaan',
            'Total CH4',
            'Total CO2',
            'Komentar',
            'Status',
            'Terakhir Diperbarui'
        ];
    }

    public function map($report): array
    {
        return [
            $report->id,
            $report->perusahaan->nama ?? '-',
            $report->total_ch4,
            $report->total_co2,
            $report->komentar,
            ucfirst($report->status),
            $report->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
