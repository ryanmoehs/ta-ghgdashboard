<?php

namespace App\Http\Controllers;

use App\Events\testWebsocket;
use Illuminate\Support\Carbon;
use App\Models\mqtt_message;
use Illuminate\Http\Request;

class MqttMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = mqtt_message::all();
        $data = mqtt_message::orderBy('timestamp')->get();;
         // Ambil masing-masing kolom untuk chart
        $timestamps = $data->pluck('timestamp')->map(function ($item) {
            return \Carbon\Carbon::parse($item)->format('H:i');
        });

        $ch4 = $data->pluck('ch4_value');
        $co2 = $data->pluck('co2_value');

        return view('dashboard', compact('timestamps', 'ch4', 'co2'));
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
