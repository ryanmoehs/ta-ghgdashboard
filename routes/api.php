<?php

use App\Http\Controllers\Api\FuelPropertiesController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\SensorController;
use App\Http\Controllers\Api\SumberEmisiController;
use App\Http\Controllers\Api\ThingspeakChannelController;
use App\Models\ThingspeakChannel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('emisi', SumberEmisiController::class);
Route::apiResource('fuel-properties', FuelPropertiesController::class);
Route::apiResource('sensor', SensorController::class);
Route::apiResource('report', ReportController::class);
Route::apiResource('channel', ThingspeakChannelController::class);
// Route::middleware('auth:sanctum')->group(function () {
// });
