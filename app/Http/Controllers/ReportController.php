<?php

namespace App\Http\Controllers;

use App\Models\mqtt_message;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function calculateTotalEmission(){
        $total_emission = 0;
        $data = mqtt_message::all();
        foreach ($data as $item) {
            $total_emission += $item->CH4 * 0.000001 + $item->CH2 * 0.000001;
        }
        return response()->json(['total_emission' => $total_emission]);
    }
}
