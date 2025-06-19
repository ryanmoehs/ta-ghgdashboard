<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'period_type',
        'period_date',
        'category_code',
        'total_co2',
        'total_ch4',
        'total_n2o',
        'avg_co2',
        'avg_ch4',
        'avg_n2o',
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
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }

    public function sumber_emisi()
    {
        return $this->belongsTo(SumberEmisi::class, 'sumber_emisi_id');
    }

    public function sensor()
    {
        return $this->belongsTo(Sensor::class, 'sensor_id');
    }
}
