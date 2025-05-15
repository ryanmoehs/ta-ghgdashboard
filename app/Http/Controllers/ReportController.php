<?php

namespace App\Http\Controllers;

use App\Exports\ReportExport;
use App\Models\mqtt_message;
use App\Models\Perusahaan;
use App\Models\Report;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        $total_emission = $this->calculateTotalEmission();
        // dd($total_emission);
        $reports = Report::all();
        return view('reports.index', compact('reports', 'total_emission'));
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

        $perusahaan = Perusahaan::all();
        return view('reports.create', compact('nama_sensor', 'total_ch4', 'total_co2', 'perusahaan'));
        // dd($perusahaan);
    }

    public function show($id){
        $report = Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }

    public function store(Request $request){
        // dd('test');

        $perusahaan = Perusahaan::all();
        $mqtt_data = mqtt_message::where('sensor_id', $request->id)->first();
        $report = new Report;
        $request->validate([
            'total_ch4' => 'required|numeric',
            'total_co2' => 'required|numeric',
            'komentar' => 'nullable|string',
            'status' => 'required|in:draft,diproses,diteruskan,diterima,dikembalikan',
        ]);

        $report->total_ch4 = $request->total_ch4;
        $report->total_co2 = $request->total_co2;
        $report->komentar = $request->komentar;
        $report->status = $request->status;
        $report->perusahaan_id = $request->perusahaan_id;
        // $report->sensor_id = $mqtt_data->id;
        $report->save();

        return redirect('/report');
    }
    
    
    public function calculateTotalEmission(){
        $total_emission = 0;
        $data = mqtt_message::all();
        foreach ($data as $item) {
            $total_emission += $item->CH4 * 0.000001 + $item->CH2 * 0.000001;
        }
        return response()->json(['total_emission' => $total_emission]);
    }

    public function export(){
        return Excel::download(new ReportExport, 'report.xlsx');
        // return "Work min!";
    }

    public function accept(Report $report){
        $report->update(['status'=>"disetujui"]);
        return redirect('/report')->with('success', 'Laporan diterima');
    }
}
