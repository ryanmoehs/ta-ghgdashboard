<?php

namespace App\Http\Controllers;

use App\Models\Maintenances;
use App\Models\Sensor;
use Illuminate\Http\Request;

class MaintenancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenance_sensor = Maintenances::with('sensor')->get();
        return view('maintenances.index', compact('maintenance_sensor'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add()
    {
        //
        $sensors = Sensor::all();
        return view('maintenances.add', compact('sensors'));
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
    public function show(Maintenances $maintenances)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenances $maintenances)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenances $maintenances)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenances $maintenances)
    {
        //
    }
}
