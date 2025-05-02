<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitPelaksanaController extends Controller
{
    //
    public function index()
    {
        return view('pelaksana.index');
    }

    public function add()
    {
        return view('pelaksana.add');
    }
}
