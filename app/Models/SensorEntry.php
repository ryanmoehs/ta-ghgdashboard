<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorEntry extends Model
{
    protected $connection = 'mqtt_mysql';
    protected $table = 'sensor_data';
    protected $fillable = [
        'sensor_id',
        'entry_id',
        'wind_speed',
        'wind_direction',
        'temperature',
        'humidity',
        'pm25',
        'pm10',
        'co2',
        'ch4',
        'inserted_at',
    ];

    public function report(){
        return $this->hasMany(Report::class, 'sensor_id', 'id');
    }
}
