<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'provinsi',
        'kab_kota',
        'kecamatan',
        'kelurahan',
        'no_telp',
        'kode_pos'
    ];
    
}
