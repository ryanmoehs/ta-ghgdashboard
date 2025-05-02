<?php

namespace App\Http\Controllers;

use App\Models\mqtt_message;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $total_emission = $this->calculateTotalEmission();
        // dd($total_emission);
        return view('reports.index', compact('total_emission'));
    }

    public function create(){
        // nama sensor
        $nama_sensor = mqtt_message::where('sensor_id', 'sensor_gas_01')
                        ->whereNotNull('sensor_id')
                        ->avg('sensor_id');
                        // ->first();
                        
        $total_ch4 = mqtt_message::where('sensor_id', 'sensor_gas_01')
                        ->whereNotNull('ch4_value')
                        ->avg('ch4_value');

        // Hitung total CO2 setahun
        $total_co2 = mqtt_message::where('sensor_id', 'sensor_gas_01')
                        ->whereNotNull('co2_value')
                        ->avg('co2_value');


        return view('reports.create', compact('nama_sensor', 'total_ch4', 'total_co2'));
        // dd($total_co2);
    }

    public function store(Request $request){
        // dd('test');

        $mqtt_data = mqtt_message::where('sensor_id', $request->id)->first();
        $report = new Report;
        $report->total_ch4 = $request->total_ch4;
        $report->total_co2 = $request->total_co2;
        $report->komentar = $request->komentar;
        $report->status = $request->status;
        $report->sensor_id = $mqtt_data->id;
        return $report->save();
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
