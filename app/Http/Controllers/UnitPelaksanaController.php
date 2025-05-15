<?php

namespace App\Http\Controllers;

use App\Models\UnitPelaksana;
use App\Models\User;
use Illuminate\Http\Request;

class UnitPelaksanaController extends Controller
{
    //
    public function index()
    {
        $pelaksana = User::all();
        // dd($pelaksana);
        return view('pelaksana.index', compact(['pelaksana']));
    }

    public function add()
    {
        return view('pelaksana.add');
    }
}
