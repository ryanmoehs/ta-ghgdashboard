<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'total_ch4',
        'total_co2',
        'komentar',
        'status',
        'perusahaan_id'
    ];

    // public function mqtt_message()
    // {
    //     return $this->belongsTo(mqtt_message::class, 'sensor_id');
    // }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id');
    }
}
