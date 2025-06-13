<?php

namespace App\Http\Controllers;

use App\Models\FuelProperties;
use App\Models\SumberEmisi;
use Illuminate\Http\Request;

class SumberEmisiController extends Controller
{
    // melihat isi sumber emisi
    public function index()
    {
        $sumberEmisis = SumberEmisi::all();
        return view('sumber_emisi.index', compact('sumberEmisis'));
    }

    public function create()
    {

        $fuelProperties = FuelProperties::all();
        return view('sumber_emisi.add', compact('fuelProperties'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'sumber' => 'required',
            'tipe_sumber' => 'required|in:kendaraan,alat_berat,boiler,lainnya',
            'frekuensi_hari' => 'required|integer|min:1',
            'kapasitas_output' => 'nullable|numeric|min:0.001',
            'unit' => 'required|in:ton,liter',
            'durasi_pemakaian' => 'required|numeric|min:0.001',
            'fuel_properties_id' => 'required|exists:fuel_properties,id',
            'dokumentasi' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $categoryMap = [
            'genset' => '1A1',
            'boiler' => '1A1',
            'alat_berat' => '1A2',
            'kendaraan' => '1A2',
            'dryer' => '1A2',
            'ventilasi' => '1B1',
            'lainnya' => '1A2'
        ];

        $categoryCode = $categoryMap[$validated['tipe_sumber']] ?? '1A2';

        $fuel = FuelProperties::findOrFail($request->fuel_properties_id);

        // dd($fuel->toArray());
        $emissionFactors = json_encode([
            "co2" => $fuel->co2_factor,
            "ch4" => $fuel->ch4_factor,
            "n2o" => $fuel->n2o_factor,
        ]);

        $filename = null;
        if ($request->hasFile('dokumentasi')) {
            $file = $request->file('dokumentasi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sumber_emisi/'), $filename);
        };
        // SumberEmisi::create([
        //     'sumber' => 'Tes Emisi',
        //     'tipe_sumber' => 'kendaraan',
        //     'category_code' => '1A2',
        //     'id_fuel_property' => 3,
        //     'kapasitas_output' => 20,
        //     'durasi_pemakaian' => 2,
        //     'frekuensi_hari' => 3,
        //     'unit' => 'liter',
        //     'emission_factors' => [
        //         'co2' => 74100,
        //         'ch4' => 3,
        //         'n2o' => 0.6,
        //     ],
        //     'dokumentasi' => 'menyala.jpg',
        // ]);
        
        
        
        SumberEmisi::create([
            'sumber' => $validated['sumber'],
            'tipe_sumber' => $validated['tipe_sumber'],
            'category_code' => $categoryCode,
            'fuel_properties_id' => $fuel->id,
            'kapasitas_output' => $request->kapasitas_output,
            'durasi_pemakaian' => $validated['durasi_pemakaian'],
            'frekuensi_hari' => $validated['frekuensi_hari'],
            'unit' => $validated['unit'],
            'emission_factors' => $emissionFactors,
            'dokumentasi' => $filename,
        ]);

        return redirect()->route('emisi.index')->with('success', 'Sumber Emisi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sumberEmisi = SumberEmisi::findOrFail($id);
        $fuelProperties = FuelProperties::all();
        return view('sumber_emisi.edit', compact('sumberEmisi', 'fuelProperties'));
    }

    public function show($id){
        $sumberEmisi = SumberEmisi::findOrFail($id);
        // dd($sumberEmisi);
        return view('sumber_emisi.show', compact('sumberEmisi'));
    }

    public function destroy($id){
        $sumberEmisi = SumberEmisi::findOrFail($id);
        $sumberEmisi->delete();
        return redirect()->route('emisi.index')->with('success', 'Sumber Emisi berhasil dihapus.');
    }

    public function test(){
        $fuel_properties_id = 1;
        $fuel = FuelProperties::findOrFail($fuel_properties_id);

        $sumber_emisi = SumberEmisi::where('fuel_properties_id', $fuel_properties_id)->first();
        $emissionFactors = [
            'co2' => $fuel->co2_factor,
            'ch4' => $fuel->ch4_factor,
            'n2o' => $fuel->n2o_factor,
        ];
        // dd(json_encode($sumber_emisi) );
        dd(SumberEmisi::latest()->first());
    }


}
