<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ThinigspeakChannelResource;
use App\Models\ThingspeakChannel;
use Illuminate\Http\Request;

class ThingspeakChannelController extends Controller
{
    //

    public function index()
    {
        $channels = ThingspeakChannel::with('sensor')->latest()->paginate(15);
        return ThinigspeakChannelResource::collection($channels);
    }
}
