<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThingspeakChannel extends Model
{
    protected $fillable = [
        'name',
        'channel_id',
        'api_read_key',
        'description',
        'latitude',
        'longitude',
    ];

    public function sensors(){
        return $this->hasMany(Sensor::class);
    }
}
