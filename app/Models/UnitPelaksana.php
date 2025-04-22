<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitPelaksana extends Model
{
    protected $fillable = [
        'alamat',
        'status_akun',
        'provinsi',
        'kab_kota',
        'kecamatan',
        'desa',
        'no_telp',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
