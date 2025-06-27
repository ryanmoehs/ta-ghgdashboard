<?php

namespace App\Http\Controllers;

use App\Models\UnitPelaksana;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function index(){
        // $users = User::all();
        $users = User::where('role', 'teknisi')->get();
        return view('teknisi.index', compact('users'));
    }
    public function create(){
        return view('teknisi.add');
    }

    public function edit($id){
        $teknisi = User::findOrFail($id);
        return view('teknisi.edit', compact('teknisi'));
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->no_hp = $request->no_hp;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        // $user->perusahaan_id = $request->perusahaan_id;

        // Update Unit Pelaksana if needed
        // $pelaksana = UnitPelaksana::where('user_id', $id)->first();
        // if ($pelaksana) {
        //     $pelaksana->alamat = $request->alamat;
        //     $pelaksana->status_akun = $request->status_akun;
        //     $pelaksana->provinsi = $request->provinsi;
        //     $pelaksana->kab_kota = $request->kab_kota;
        //     $pelaksana->kecamatan = $request->kecamatan;
        //     $pelaksana->desa = $request->desa;
        //     $pelaksana->no_telp = $request->no_telp;
        //     $pelaksana->save();
        // }

        $user->save();
        
        return redirect('/teknisi')->with('success', 'User updated successfully.');
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

        // $pelaksana = new UnitPelaksana([
        //     'alamat' => $request->alamat,
        //     'status_akun' => $request->status_akun,
        //     'provinsi' => $request->provinsi,
        //     'kab_kota' => $request->kab_kota,
        //     'kecamatan' => $request->kecamatan,
        //     'desa' => $request->desa,
        //     'no_telp' => $request->no_telp,
        // ]);

        $user->save();
        return redirect('/teknisi')->with('success', 'User created successfully.');
        
    }
}
