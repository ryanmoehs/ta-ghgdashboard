<?php

use App\Http\Controllers\MqttMessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
