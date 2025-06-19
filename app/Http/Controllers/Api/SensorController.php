<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SensorResource;
use App\Models\Sensor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sensors = Sensor::all();
        return SensorResource::collection($sensors);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sensor_name' => 'required|string|max:255',
            'field' => 'required|string|max:255',
            'parameter_name' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'latitude' => 'required|string|max:255',
            'longitude' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // Unprocessable Entity
        };

        $sensor = Sensor::create([
            'sensor_name' => $request->sensor_name,
            'field' => $request->field,
            'parameter_name' => $request->parameter_name,
            'unit' => $request->unit,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return (new SensorResource($sensor))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
