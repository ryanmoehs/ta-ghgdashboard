<?php

namespace App\Http\Controllers;

use App\Models\UnitPelaksana;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function create(){
        return view('pelaksana.add');
    }

    public function store(Request $request){
        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'perusahaan_id' => $request->perusahaan_id
        ]);

        $pelaksana = new UnitPelaksana([
            'alamat' => $request->alamat,
            'status_akun' => $request->status_akun,
            'provinsi' => $request->provinsi,
            'kab_kota' => $request->kab_kota,
            'kecamatan' => $request->kecamatan,
            'desa' => $request->desa,
            'no_telp' => $request->no_telp,
        ]);

        $user->save();
        $pelaksana->user()->associate($user);
        return redirect('/pelaksana')->with('success', 'User created successfully.');
        
    }
}
