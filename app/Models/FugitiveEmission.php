<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FugitiveEmission extends Model
{
    protected $fillable = [
        'sumber_emisi_ids',
        'source_name',
        'gas_type',
        'quantity_used',
        'unit',
        'conversion_factor',
        'emission_factor',
        'total_emission_ton',
        'period'
    ];

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class);
    }

    public function report(){
        return $this->belongsTo(Report::class);
    }
}
