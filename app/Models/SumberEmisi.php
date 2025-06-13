<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberEmisi extends Model
{
    protected $table = 'sumber_emisis';
    protected $fillable = [
        'sumber', // nama alat atau sumber
        'tipe_sumber', 
        'kapasitas_output', // output energi per-jam (jika diketahui)
        'frekuensi_hari', // jumlah hari aktif
        'unit', // sesuai dengan jenis bbm
        'emission_factors', // { "co2": ..., "ch4": ..., "n2o": ... }
        'faktor_konsumsi',
        'durasi_pemakaian',
        'dokumentasi',
        'fuel_properties_id'
    ];

    protected $casts = [
        'emission_factors' => 'array',
    ];

    public function fuel_properties(){
        return $this->belongsTo(FuelProperties::class);
    }

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class);
    }

    
}

