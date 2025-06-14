<?php

namespace App\Http\Controllers;

use App\Events\testWebsocket;
use Illuminate\Support\Carbon;
use App\Models\mqtt_message;
use App\Models\Report;
use App\Models\Sensor;
use Illuminate\Http\Request;

class MqttMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = mqtt_message::all();
        $data = mqtt_message::orderBy('inserted_at')->get();;
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

        $reports = Report::all();

        return view('dashboard', compact(
            'timestamps', 'ch4', 'co2', 'pm25', 'pm10', 'temperature', 'humidity', 'sensors', 'reports',
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
    public function show(mqtt_message $mqtt_message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mqtt_message $mqtt_message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mqtt_message $mqtt_message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mqtt_message $mqtt_message)
    {
        //
    }

    // public function test()
    // {
    //     event(new testWebsocket());
    // }

    
}
