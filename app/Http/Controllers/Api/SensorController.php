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
        $sensors = Sensor::all();
        return response()->json([
            'success' => true,
            'message' => 'List of sensors',
            'data' => SensorResource::collection($sensors)
        ], 200);
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
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $sensor = Sensor::create($request->only([
            'sensor_name', 'field', 'parameter_name', 'unit', 'latitude', 'longitude'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Sensor created successfully',
            'data' => new SensorResource($sensor)
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sensor = Sensor::find($id);
        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => 'Sensor detail',
            'data' => new SensorResource($sensor)
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sensor = Sensor::find($id);
        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'sensor_name' => 'sometimes|required|string|max:255',
            'field' => 'sometimes|required|string|max:255',
            'parameter_name' => 'sometimes|required|string|max:255',
            'unit' => 'sometimes|required|string|max:255',
            'latitude' => 'sometimes|required|string|max:255',
            'longitude' => 'sometimes|required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation errors',
                'errors' => $validator->errors()
            ], 422);
        }

        $sensor->update($request->only([
            'sensor_name', 'field', 'parameter_name', 'unit', 'latitude', 'longitude'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Sensor updated successfully',
            'data' => new SensorResource($sensor)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sensor = Sensor::find($id);
        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Sensor not found',
            ], 404);
        }
        $sensor->delete();
        return response()->json([
            'success' => true,
            'message' => 'Sensor deleted successfully',
        ], 200);
    }
}
