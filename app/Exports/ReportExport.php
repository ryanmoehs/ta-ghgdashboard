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
    public function collection()
    {
        // return Report::all();
        return Report::with('perusahaan')->get();
        // return Report::select('id', 'total_ch4', 'total_co2', 'komentar', 'status', 'created_at')->get();

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
