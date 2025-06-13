<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SumberEmisiResource;
use App\Models\FuelProperties;
use App\Models\SumberEmisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SumberEmisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    
        $sumberEmisis = SumberEmisi::with('fuel_properties')->latest()->paginate(15);
        return SumberEmisiResource::collection($sumberEmisis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sumber' => 'required|string|max:255',
            'tipe_sumber' => 'required|in:kendaraan,alat_berat,boiler,lainnya',
            'frekuensi_hari' => 'required|integer|min:1',
            'kapasitas_output' => 'nullable|numeric|min:0.001',
            'unit' => 'required|in:ton,liter',
            'durasi_pemakaian' => 'required|numeric|min:0.001',
            'fuel_properties_id' => 'required|exists:fuel_properties,id',
            'dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422); // Unprocessable Entity
        }

        $categoryMap = [
            'genset' => '1A1',
            'boiler' => '1A1',
            'alat_berat' => '1A2',
            'kendaraan' => '1A2',
            'dryer' => '1A2',
            'ventilasi' => '1B1',
            'lainnya' => '1A2'
        ];

        $categoryCode = $categoryMap[$validator['tipe_sumber']] ?? '1A2';

        $fuel = FuelProperties::findOrFail($request->fuel_properties_id);

        // dd($fuel->toArray());
        $emissionFactors = json_encode([
            "co2" => $fuel->co2_factor,
            "ch4" => $fuel->ch4_factor,
            "n2o" => $fuel->n2o_factor,
        ]);

        $filename = null;
        if ($request->hasFile('dokumentasi')) {
            $filename = $request->file('dokumentasi')->store('public/sumber_emisi');
            $filename = basename($filename); // Ambil nama filenya saja
        };

        $sumberEmisi = SumberEmisi::create([
            'sumber' => $request->sumber,
            'tipe_sumber' => $request->tipe_sumber,
            'category_code' => $categoryCode,
            'fuel_properties_id' => $fuel->id,
            'kapasitas_output' => $request->kapasitas_output,
            'durasi_pemakaian' => $request->durasi_pemakaian,
            'frekuensi_hari' => $request->frekuensi_hari,
            'unit' => $request->unit,
            'emission_factors' => $emissionFactors,
            'dokumentasi' => $filename,
        ]);

        return (new SumberEmisiResource($sumberEmisi->load('fuel_properties')))
                ->response()
                ->setStatusCode(201);
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
