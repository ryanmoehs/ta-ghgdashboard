<?php

use App\Models\ThingspeakChannel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SensorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\SensorEntryController;
use App\Http\Controllers\SumberEmisiController;
use App\Http\Controllers\MaintenancesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UnitPelaksanaController;
use App\Http\Controllers\FuelPropertiesController;
use App\Http\Controllers\ThingspeakChannelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'role:unit_lingkungan'])->group(function () {
    Route::get('/dashboard', [SensorEntryController::class, 'index'])->name('dashboard');
    Route::get('/', [SensorEntryController::class, 'index'])->name('home');
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
    Route::get('/report/{id}', [ReportController::class, 'show'])->name('report.show');
    Route::post('/report/create', [ReportController::class, 'store'])->name('report.store');
    Route::get('/report-export', [ReportController::class, 'export'])->name('report.export');
    // Route::

    Route::get('/data-teknisi', [UserController::class, 'index'])->name('teknisi.index');
    Route::get('/data-teknisi/add', [UserController::class, 'create'])->name('teknisi.add');
    Route::post('/data-teknisi/add', [UserController::class, 'store'])->name('teknisi.store');
    Route::get('/data-teknisi/edit/{id}', [UserController::class, 'edit'])->name('teknisi.edit');
    Route::patch('/data-teknisi/{id}', [UserController::class, 'update'])->name('teknisi.update');
    Route::delete('/data-teknisi/{id}', [UserController::class, 'destroy'])->name('teknisi.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::get('/perusahaan', [PerusahaanController::class, 'index'])->name('company.index');
    Route::get('/perusahaan/edit/{id}', [PerusahaanController::class, 'edit'])->name('company.edit');
    Route::post('/perusahaan/edit/{id}', [PerusahaanController::class, 'update'])->name('company.update');
    Route::match(['put', 'patch'], '/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/emisi', [SumberEmisiController::class, 'index'])->name('emisi.index');
    Route::get('/emisi/tambah', [SumberEmisiController::class, 'create'])->name('emisi.create');
    Route::post('/emisi/tambah', [SumberEmisiController::class, 'store'])->name('emisi.store');
    Route::get('/emisi/{id}', [SumberEmisiController::class, 'show'])->name('emisi.show');
    Route::get('/emisi/edit/{id}', [SumberEmisiController::class, 'edit'])->name('emisi.edit');
    Route::delete('/emisi/{id}', [SumberEmisiController::class, 'destroy'])->name('emisi.destroy');
    Route::match(['put', 'patch'], '/emisi/{id}', [SumberEmisiController::class, 'update'])->name('emisi.update');
    Route::get('/emisi-export', [SumberEmisiController::class, 'export'])->name('emisi.export');
    Route::get('/maintenance', [MaintenancesController::class, 'index'])->name('maintenance.index');
    Route::get('/maintenance/add', [MaintenancesController::class, 'add'])->name('maintenance.add');
    
    Route::get('/sensor', [SensorController::class, 'index'])->name('sensor.index');
    Route::get('/sensor/create', [SensorController::class, 'create'])->name('sensor.create');
    Route::post('/sensor/create', [SensorController::class, 'store'])->name('sensor.store');
    Route::get('/sensor/{id}', [SensorController::class, 'show'])->name('sensor.show');
    Route::get('/sensor/{id}/edit', [SensorController::class, 'edit'])->name('sensor.edit');
    // Route::get('/channel/add', [ThingspeakChannelController::class, 'add_channel'])->name('channel.add');
    // Route::post('/channel/add', [ThingspeakChannelController::class, 'store'])->name('channel.store');
    Route::get('/sensor/export', [SensorController::class, 'export']);
    // Route::get('/sensor', [ThingspeakChannelController::class, 'index'])->name('sensor.index');
    Route::match(['put', 'patch'], '/sensor/{id}', [SensorController::class, 'update'])->name('sensor.update');
    Route::delete('/sensor/{id}', [SensorController::class, 'destroy'])->name('sensor.destroy');
    
    Route::get('/fuel-props', [FuelPropertiesController::class, 'index'])->name('fuel_props.index');
    Route::get('/fuel-props/add', [FuelPropertiesController::class, 'addFuelProps'])->name('fuel_props.add');
    Route::post('/fuel-props/add', [FuelPropertiesController::class, 'store'])->name('fuel_props.store');
    Route::get('/fuel-props/edit/{id}', [FuelPropertiesController::class, 'editFuelProps'])->name('fuel_props.edit');
    Route::match(['put', 'patch'], '/fuel-props/{id}', [FuelPropertiesController::class, 'update'])->name('fuel_props.update');
    Route::delete('/fuel-props/{id}', [FuelPropertiesController::class, 'destroy'])->name('fuel_props.destroy');
});

Route::middleware(['auth', 'role:teknisi'])->prefix('teknisi')->group(function () {
    Route::get('/dashboard', [SensorEntryController::class, 'index'])->name('teknis.dashboard');
    Route::get('/maintenance', [MaintenancesController::class, 'index'])->name('maintenances.index');
    Route::get('/maintenance/update', [MaintenancesController::class, 'add'])->name('maintenance.add');

    // Route::get('/emisi', [SumberEmisiController::class, 'index'])->name('emisi.index');
    // Route::get('/emisi/tambah', [SumberEmisiController::class, 'create'])->name('emisi.create');
    // Route::post('/emisi/tambah', [SumberEmisiController::class, 'store'])->name('emisi.store');
    // Route::get('/emisi/{id}', [SumberEmisiController::class, 'show'])->name('emisi.show');
    // Route::get('/emisi/edit/{id}', [SumberEmisiController::class, 'edit'])->name('emisi.edit');
    // Route::delete('/emisi/{id}', [SumberEmisiController::class, 'destroy'])->name('emisi.destroy');
    // Route::match(['put', 'patch'], '/emisi/{id}', [SumberEmisiController::class, 'update'])->name('emisi.update');
    // Route::get('/emisi-export', [SumberEmisiController::class, 'export'])->name('emisi.export');
    // Route::get('/maintenance', [MaintenancesController::class, 'index'])->name('maintenance.index');
    // Route::get('/maintenance/add', [MaintenancesController::class, 'add'])->name('maintenance.add');
    
    // Route::get('/data-sensor', [SensorController::class, 'index'])->name('sensor.index');
    // Route::get('/data-sensor/create', [SensorController::class, 'create'])->name('sensor.create');
    // Route::post('/data-sensor/create', [SensorController::class, 'store'])->name('sensor.store');
    // Route::get('/data-sensor/{id}', [SensorController::class, 'show'])->name('sensor.show');
    // Route::get('/data-sensor/{id}/edit', [SensorController::class, 'edit'])->name('sensor.edit');
    // Route::get('/channel/add', [ThingspeakChannelController::class, 'add_channel'])->name('channel.add');
    // Route::post('/channel/add', [ThingspeakChannelController::class, 'store'])->name('channel.store');
    Route::get('/data-sensor/export', [SensorController::class, 'export']);
    // Route::get('/data-sensor', [ThingspeakChannelController::class, 'index'])->name('sensor.index');
    Route::match(['put', 'patch'], '/data-sensor/{id}', [SensorController::class, 'update'])->name('sensor.update');
    Route::delete('/data-sensor/{id}', [SensorController::class, 'destroy'])->name('sensor.destroy');
});

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::get('/emisi-test', [SumberEmisiController::class, 'test'])->name('emisi.test');
require __DIR__.'/auth.php';
