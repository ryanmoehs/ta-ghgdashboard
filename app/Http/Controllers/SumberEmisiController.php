<?php

namespace App\Http\Controllers;

use App\Exports\SumberEmisiExport;
use App\Models\FuelProperties;
use App\Models\SumberEmisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;

class SumberEmisiController extends Controller
{
    // melihat isi sumber emisi
    public function index(Request $request)
    {
        $searchEmisi = $request->input('search_emisi');
        $searchFuel = $request->input('search_fuel');

        $sumberEmisiQuery = SumberEmisi::query();
        $fuelPropertiesQuery = FuelProperties::query();

        if ($searchEmisi) {
            $sumberEmisiQuery->where('sumber', 'like', "%$searchEmisi%")
                ->orWhere('tipe_sumber', 'like', "%$searchEmisi%")
                ->orWhere('kapasitas_output', 'like', "%$searchEmisi%")
                ->orWhere('unit', 'like', "%$searchEmisi%")
                ;
        }
        if ($searchFuel) {
            $fuelPropertiesQuery->where('fuel_type', 'like', "%$searchFuel%")
                ->orWhere('conversion_factor', 'like', "%$searchFuel%")
                ;
        }

        $fuelProperties = $fuelPropertiesQuery->paginate(5, ['*'], 'fuel_page');
        $sumberEmisis = $sumberEmisiQuery->paginate(5, ['*'], 'emisi_page');

        // Jika AJAX dan hanya ingin tabel fuel properties
        if ($request->ajax() && $request->has('fuel_only')) {
            // Render hanya bagian tabel fuel properties dari blade utama
            $view = view('sumber_emisi.index', [
                'sumberEmisis' => $sumberEmisis,
                'fuelProperties' => $fuelProperties,
                'onlyFuelTable' => true
            ])->renderSections();
            return response()->json(['html' => $view['fuel_table']]);
        }
        return view('sumber_emisi.index', compact('sumberEmisis', 'fuelProperties'));
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

        // Tambahkan pemanggilan command perhitungan otomatis
        Artisan::call('app:generate-fuel-combustion-activity');

        return redirect()->route('emisi.index')->with('success', 'Sumber Emisi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $sumberEmisi = SumberEmisi::findOrFail($id);
        $fuelProperties = FuelProperties::all();
        $tipeSumberOptions = [
            'kendaraan' => 'Kendaraan',
            'alat_berat' => 'Alat Berat',
            'boiler' => 'Boiler',
            'lainnya' => 'Lainnya',
            'genset' => 'Genset',
            'dryer' => 'Dryer',
            'ventilasi' => 'Ventilasi Tambang',
        ];
        return view('sumber_emisi.edit', compact('sumberEmisi', 'fuelProperties', 'tipeSumberOptions'));
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

    public function update(Request $request, $id)
{
        $sumberEmisi = SumberEmisi::findOrFail($id);

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

        $fuel = FuelProperties::findOrFail($request->fuel_properties_id);
        $emissionFactors = json_encode([
            "co2" => $fuel->co2_factor,
            "ch4" => $fuel->ch4_factor,
            "n2o" => $fuel->n2o_factor,
        ]);

        // Handle file upload
        if ($request->hasFile('dokumentasi')) {
            // Hapus file lama jika ada
            if ($sumberEmisi->dokumentasi && file_exists(public_path('uploads/sumber_emisi/' . $sumberEmisi->dokumentasi))) {
                unlink(public_path('uploads/sumber_emisi/' . $sumberEmisi->dokumentasi));
            }
            $file = $request->file('dokumentasi');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/sumber_emisi/'), $filename);
            $sumberEmisi->dokumentasi = $filename;
        }

        // Update data lain
        $sumberEmisi->sumber = $validated['sumber'];
        $sumberEmisi->tipe_sumber = $validated['tipe_sumber'];
        $sumberEmisi->category_code = $sumberEmisi->category_code; // atau update jika perlu
        $sumberEmisi->fuel_properties_id = $fuel->id;
        $sumberEmisi->kapasitas_output = $request->kapasitas_output;
        $sumberEmisi->durasi_pemakaian = $validated['durasi_pemakaian'];
        $sumberEmisi->frekuensi_hari = $validated['frekuensi_hari'];
        $sumberEmisi->unit = $validated['unit'];
        $sumberEmisi->emission_factors = $emissionFactors;

        $sumberEmisi->save();

        return redirect()->route('emisi.index')->with('success', 'Sumber Emisi berhasil diupdate.');
    }

    public function export(){
        return Excel::download(new SumberEmisiExport, 'sumber_emisi.xlsx');
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
