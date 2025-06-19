<?php

namespace App\Http\Controllers;

use App\Exports\SensorExport;
use App\Models\Sensor;
use App\Models\ThingspeakChannel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Artisan;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all sensors from the database
        $sensors = Sensor::all();
        // $channels = ThingspeakChannel::all();
        // return view('sensor.index', compact('sensors', 'channels'));
        return view('sensor.index', compact('sensors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return the view for creating a new sensor
        // $channels = ThingspeakChannel::all();
        // return view('sensor.create', compact('channels'));
        return view('sensor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        // $request->validate([
        //     'sensor_id' => 'required|string|max:255',
        //     'sensor_type' => 'required|string|max:255',
        //     'latitude' => 'required|numeric',
        //     'longitude' => 'required|numeric',
        // ]);
        $validated = $request->validate([
            'field' => 'required|string|max:255',
            'sensor_name' => 'required|string|max:255',
            'parameter_name' => 'required|string|max:255',
            'unit' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
        // Create a new sensor instance
        Sensor::create([
            // 'thingspeak_channel_id' => $validated['thingspeak_channel_id'],
            'field' => $validated['field'],
            'sensor_name' => $validated['sensor_name'],
            'parameter_name' => $validated['parameter_name'],
            'unit' => $validated['unit'],
            'description' => $validated['description'] ?? null, // Optional description
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
        ]);

        // Tambahkan pemanggilan command perhitungan otomatis
        Artisan::call('app:generate-fuel-combustion-activity');

        return redirect()->route('sensor.index')->with('success', 'Sensor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sensor $sensor)
    {
        //  Return the view with the sensor data
        return view('sensor.show', compact('sensor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sensor = Sensor::findOrFail($id);
        return view('sensor.edit', compact('sensor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $sensor = Sensor::findOrFail($id); // Ensure the sensor exists
        $sensor->update($request->all()); // Update the sensor with request data
        return redirect()->route('sensor.index')->with('success', 'Sensor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the sensor by ID
        $sensor = Sensor::findOrFail($id);
        // Delete the sensor from the database
        $sensor->delete();
        // Redirect to the sensors index page with a success message
        return redirect()->route('sensor.index')->with('success', 'Sensor deleted successfully.');
    }

    public function export(){
        return Excel::download(new SensorExport, 'sensor.xlsx');
    }
}
