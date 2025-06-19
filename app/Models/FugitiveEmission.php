<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FugitiveEmission extends Model
{
    protected $fillable = [
        'source_name',
        'production_amount',
        'emission_factor',
        'ch4_emission_ton',
        'co2_emission_ton', // Optional, if needed
        'co2e_emission_ton',
        'period',
        'company_id'
    ];

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class);
    }

    public function report(){
        return $this->belongsTo(Report::class);
    }
}
