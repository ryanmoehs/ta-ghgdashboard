<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mqtt_message extends Model
{
    protected $connection = 'mqtt_mysql';
    protected $table = 'sensor_data';
    protected $fillable = [
        'sensor_id',
        'entry_id',
        'ch4_value',
        'co2_value',
        'timestamp',
    ];

    public function report(){
        return $this->hasMany(Report::class, 'sensor_id', 'id');
    }
}
