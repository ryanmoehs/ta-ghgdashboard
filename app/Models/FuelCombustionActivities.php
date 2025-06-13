<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelCombustionActivities extends Model
{
    protected $fillable = [
        'sumber_emisi_id',
        'source_name',
        'fuel_type',
        'quantity_used',
        'unit',
        'conversion_factor',
        'emission_factor',
        'total_emission_ton',
        'period'
    ];

    protected $casts = [
        'emission_factor' => 'array',
        'total_emission_ton' => 'array',
        'period' => 'date',
    ];

    public function sumber_emisis(){
        return $this->belongsTo(SumberEmisi::class);
    }

    public function report(){
        return $this->belongsTo(Report::class);
    }
}
