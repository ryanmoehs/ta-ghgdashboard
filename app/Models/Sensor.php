<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    protected $fillable = [
        'sensor_name',
        'device',
        'installation_date'
    ];
    protected $casts = [
        'installation_date' => 'date:Y-m-d'
    ];

}
