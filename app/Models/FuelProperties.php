<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelProperties extends Model
{
    protected $fillable = [
        'fuel_type',
        'unit',
        'conversion_factor', // mengacu pada https://www.esdm.go.id/assets/media/content/content-faktor-emisi-bahan-bakar-minyak-bbm-dan-batubara.pdf 
        'co2_factor',
        'ch4_factor',
        'n2o_factor'
    ];

    public function sumber_emisis(){
        return $this->hasMany(SumberEmisi::class);
    }
}
