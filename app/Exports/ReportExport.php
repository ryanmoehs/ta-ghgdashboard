<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    /**
    * @var string
    */
    protected $periodType;
    protected $tanggal;
    protected $bulan;
    protected $tahun;

    public function __construct($periodType = 'harian', $tanggal = null, $bulan = null, $tahun = null)
    {
        $this->periodType = $periodType;
        $this->tanggal = $tanggal;
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        $query = Report::with(['perusahaan', 'sumber_emisi', 'sensor']);
        if ($this->periodType === 'harian' && $this->tanggal) {
            // Ganti filter ke period_date, bukan updated_at
            $query->whereDate('period_date', $this->tanggal);
        } elseif ($this->periodType === 'bulanan' && $this->bulan) {
            [$year, $month] = explode('-', $this->bulan);
            $query->whereYear('period_date', $year)->whereMonth('period_date', $month);
        } elseif ($this->periodType === 'tahunan' && $this->tahun) {
            $query->whereYear('period_date', $this->tahun);
        }
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            // 'Nama Laporan',
            'Tipe Periode',
            'Tanggal Periode',
            'Kode Kategori',
            'Total CO2',
            'Total CH4',
            'Total N2O',
            'Total PM2.5',
            'Total PM10',
            'Rata-rata CO2',
            'Rata-rata CH4',
            'Rata-rata N2O',
            'Rata-rata PM2.5',
            'Rata-rata PM10',
            'Komentar',
            'Perusahaan',
            'Sumber Emisi',
            'Sensor',
            'Terakhir Diperbarui'
        ];
    }

    public function map($report): array
    {
        return [
            $report->id,
            // $report->report_name,
            $report->period_type,
            $report->period_date,
            $report->category_code,
            $report->total_co2,
            $report->total_ch4,
            $report->total_n2o,
            $report->total_pm25,
            $report->total_pm10,
            $report->avg_co2,
            $report->avg_ch4,
            $report->avg_n2o,
            $report->avg_pm25,
            $report->avg_pm10,
            $report->komentar,
            $report->perusahaan ? $report->perusahaan->nama : '-',
            $report->sumber_emisi ? $report->sumber_emisi->nama : '-',
            $report->sensor ? $report->sensor->sensor_name : '-',
            ucfirst($report->status ?? '-'),
            optional($report->updated_at)->format('Y-m-d H:i:s'),
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $firstReport = $this->collection()->first();
                $perusahaan = $firstReport && $firstReport->perusahaan ? $firstReport->perusahaan : null;
                $sheet = $event->sheet->getDelegate();
                $row = 1;
                if ($perusahaan) {
                    $sheet->setCellValue('A'.$row++, 'Identitas Perusahaan');
                    $sheet->setCellValue('A'.$row++, 'Nama');
                    $sheet->setCellValue('B'.($row-1), $perusahaan->nama);
                    $sheet->setCellValue('A'.$row++, 'Alamat');
                    $sheet->setCellValue('B'.($row-1), $perusahaan->alamat);
                    $sheet->setCellValue('A'.$row++, 'Provinsi');
                    $sheet->setCellValue('B'.($row-1), $perusahaan->provinsi);
                    $sheet->setCellValue('A'.$row++, 'Kab/Kota');
                    $sheet->setCellValue('B'.($row-1), $perusahaan->kab_kota);
                    $sheet->setCellValue('A'.$row++, 'Kecamatan');
                    $sheet->setCellValue('B'.($row-1), $perusahaan->kecamatan);
                    $sheet->setCellValue('A'.$row++, 'Kelurahan');
                    $sheet->setCellValue('B'.($row-1), $perusahaan->kelurahan);
                    $sheet->setCellValue('A'.$row++, 'No. Telp');
                    $sheet->setCellValue('B'.($row-1), $perusahaan->no_telp);
                    $sheet->setCellValue('A'.$row++, 'Kode Pos');
                    $sheet->setCellValue('B'.($row-1), $perusahaan->kode_pos);
                    $row++;
                }
            }
        ];
    }
}
