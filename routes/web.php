<?php

use App\Http\Controllers\MqttMessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UnitPelaksanaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SensorController;
use Illuminate\Support\Facades\Route;

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



// Admin Middleware
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.adm-dash')->middleware(['auth', 'verified']);
    Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout')->middleware(['auth', 'verified']);
    Route::get('/trafo-data', [TrafoController::class, 'index'])->middleware(['auth', 'verified'])->name('trafo-data');
    Route::get('/trafo-register', [TrafoController::class, 'create'])->name('trafo-register');
    Route::post('/trafo-register', [TrafoController::class, 'store'])->name('trafo.store');
    Route::get('/trafo/{id}', [TrafoController::class, 'show'])->name('trafo.show');
    Route::get('/add-performance', function () {
        return view('trafo.add-performance');
    });
    Route::get('/new', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('register-user');
    Route::post('/new', [UserController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.regist');
});

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// })->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [MqttMessageController::class, 'index'])->name('dashboard');
    Route::get('/', [MqttMessageController::class, 'index'])->name('home');
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/report/create', [ReportController::class, 'create'])->name('report.create');
    Route::post('/report/create', [ReportController::class, 'store'])->name('report.store');
    Route::get('/pelaksana', [UnitPelaksanaController::class, 'index'])->name('pelaksana.index');
    Route::get('/pelaksana/add', [UnitPelaksanaController::class, 'add'])->name('pelaksana.add');
    Route::post('/pelaksana/add', [UserController::class, 'store'])->name('pelaksana.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/sensor-location', [SensorController::class, 'index'])->name('sensor.index');
    Route::get('/sensor-location/create', [SensorController::class, 'create'])->name('sensor.create');
    Route::post('/sensor-location/create', [SensorController::class, 'store'])->name('sensor.store');
    Route::get('/sensor-location/{id}', [SensorController::class, 'show'])->name('sensor.show');
    Route::get('/sensor-location/{id}/edit', [SensorController::class, 'edit'])->name('sensor.edit');
    Route::match(['put', 'patch'], '/sensor-location/{id}', [SensorController::class, 'update'])->name('sensor.update');
    Route::delete('/sensor-location/{id}', [SensorController::class, 'destroy'])->name('sensor.destroy');
});

require __DIR__.'/auth.php';
