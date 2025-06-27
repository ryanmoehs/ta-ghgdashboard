<?php

namespace App\Http\Controllers\Api;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PerusahaanResource;

class PerusahaanController extends Controller
{
    public function index(){
        // $perusahaan = Perusahaan::with(['sumber_emisis'])->latest()->paginate(15);
        $perusahaan = Perusahaan::all();
        return PerusahaanResource::collection($perusahaan);
    }
}
