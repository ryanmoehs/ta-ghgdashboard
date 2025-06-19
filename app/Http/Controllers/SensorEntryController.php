<?php

namespace App\Http\Controllers;

use App\Events\testWebsocket;
use Illuminate\Support\Carbon;
use App\Models\SensorEntry;
use App\Models\Report;
use App\Models\Sensor;
use App\Models\ThingspeakChannel;
use Illuminate\Http\Request;

class SensorEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = SensorEntry::all();
        $data = SensorEntry::orderBy('inserted_at')->get();
         // Ambil masing-masing kolom untuk chart
        $timestamps = $data->pluck('inserted_at')->map(function ($item) {
            return \Carbon\Carbon::parse($item)->format('H:i');
        });

        $sensors = Sensor::all();

        $ch4 = $data->pluck('ch4');
        $co2 = $data->pluck('co2');
        $pm25 = $data->pluck('pm25');
        $pm10 = $data->pluck('pm10');
        $temperature = $data->pluck('temperature')->last();
        $humidity = $data->pluck('humidity')->last();

        // buat gauge chart
        $latest_co2 = $data->pluck('co2')->last();
        $latest_ch4 = $data->pluck('ch4')->last();
        $latest_pm25 = $data->pluck('pm25')->last();
        $latest_pm10 = $data->pluck('pm10')->last();

        // $reports = Report::all();
        // dd($data);

        return view('dashboard', compact(
            'timestamps', 'ch4', 'co2', 'pm25', 'pm10', 'temperature', 'humidity', 'sensors',
            'latest_co2', 'latest_ch4', 'latest_pm25', 'latest_pm10'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SensorEntry $sensor_entry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SensorEntry $sensor_entry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SensorEntry $sensor_entry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SensorEntry $sensor_entry)
    {
        //
    }

    // public function test()
    // {
    //     event(new testWebsocket());
    // }

    
}
