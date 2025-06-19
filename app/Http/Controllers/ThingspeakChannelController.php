<?php

namespace App\Http\Controllers;

use App\Models\SensorEntry;
use App\Models\Thingspeak_Channel;
use App\Models\ThingspeakChannel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ThingspeakChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sensors = ThingspeakChannel::with('sensors')->get();
        // dd($sensors);
        return view('sensor.index', compact('sensors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add_channel()
    {
        //
        return view('sensor.add_channel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = $request->validate([
            'channel_id' => 'required|numeric|unique:thingspeak_channels,channel_id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
            'api_read_key' => 'nullable|string|max:255',
        ]);

        ThingspeakChannel::create([
            'channel_id' => $validator['channel_id'],
            'name' => $validator['name'],
            'description' => $validator['description'],
            'latitude' => $validator['latitude'],
            'longitude' => $validator['longitude'],
            'api_read_key' => $validator['api_read_key'],
        ]);

        return redirect()->route('sensor.index')->with('success', 'Channel created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ThingspeakChannel $thingspeakChannel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ThingspeakChannel $thingspeakChannel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ThingspeakChannel $thingspeakChannel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ThingspeakChannel $thingspeakChannel)
    {
        //
    }

    public function sync(ThingspeakChannel $thingspeakChannel){
        $url = "https://api.thingspeak.com/channels/{$thingspeakChannel->channel_id}/fields.json";
        $response = Http::get($url, [
            'api_key' => $thingspeakChannel->api_read_key,
            'result' => 1
        ]);

        if (!$response->ok()) {
            return back()->with('error', 'Gagal mengambil data dari ThingSpeak.');
        };

        $feeds = $response->json('feeds');
        if (empty($feeds)) {
            return back()->with('warning', 'Tidak ada data ditemukan.');
        };

        $latest = $feeds[0];
        $createdAt = Carbon::parse($latest['created_at']);

        if (SensorEntry::where('entry_id', $latest['entry_id'])->exists()) {
            return back()->with('info', 'Data sudah ada.');
        }
    
        SensorEntry::create([
            'entry_id' => $latest['entry_id'],
            'sensor_id' => $thingspeakChannel->channel_id,
            'created_at' => $createdAt,
            'wind_speed' => $latest['field1'] ?? 0,
            'wind_direction' => $latest['field2'] ?? 0,
            'temperature' => $latest['field3'] ?? 0,
            'humidity' => $latest['field4'] ?? 0,
            'pm25' => $latest['field5'] ?? 0,
            'pm10' => $latest['field6'] ?? 0,
            'co2' => $latest['field7'] ?? 0,
            'ch4' => $latest['field8'] ?? 0,
            'inserted_at' => now(),
        ]);
    
        return back()->with('success', 'Data berhasil disimpan.');

    }

    public function detectFields(Request $request)
    {
        $request->validate([
            'channel_id' => 'required|numeric',
            'api_read_key' => 'nullable|string|max:255'
        ]);

        $channelId = $request->channel_id;
        $apiKey = $request->api_read_key;

        $url = "https://api.thingspeak.com/channels/{$channelId}/fields.json";
        $response = Http::get($url, [
            'api_key' => $apiKey,
        ]);

        if (!$response->ok()) {
            return back()->with('error', 'Gagal mengambil metadata dari ThingSpeak.');
        }

        $channelInfo = $response->json('channel');

        $fields = [];
        for ($i = 1; $i <= 8; $i++) {
            $key = "field{$i}";
            if (!empty($channelInfo[$key])) {
                $fields[] = [
                    'field' => $key,
                    'label' => $channelInfo[$key]
                ];
            }
        }

        return view('sensor.detected-fields', compact('fields', 'channelId', 'apiKey'));
    }

}
