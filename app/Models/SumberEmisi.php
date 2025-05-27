<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SumberEmisi extends Model
{
    protected $fillable = [
        'sumber', // nama alat atau sumber
        'tipe_sumber', 
        'kapasitas_output', // output energi per-jam (jika diketahui)
        'frekuensi_hari', // jumlah hari aktif
        'unit', // sesuai dengan jenis bbm
        'emission_factor', // { "co2": ..., "ch4": ..., "n2o": ... }
        'faktor_konsumsi',
        'durasi_pemakaian',
        'dokumentasi',
        'id_fuel_properties'
    ];

    public function fuel_properties(){
        return $this->hasMany(FuelProperties::class);
    }

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class);
    }

    
}

