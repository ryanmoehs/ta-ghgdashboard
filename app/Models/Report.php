<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'report_name',
        'period_type',
        'period_date',
        'category_code',
        'total_co2',
        'total_ch4',
        'total_n2o',
        'total_pm25',
        'total_pm10',
        'avg_co2',
        'avg_ch4',
        'avg_n2o',
        'avg_pm25',
        'avg_pm10',
        'komentar',
        'perusahaan_id',
        'sumber_emisi_id',
        'sensor_id'
    ];

    // public function sensor_entries()
    // {
    //     return $this->belongsTo(sensor_entries::class, 'sensor_id');
    // }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    public function sumber_emisi()
    {
        return $this->belongsTo(SumberEmisi::class);
    }

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
