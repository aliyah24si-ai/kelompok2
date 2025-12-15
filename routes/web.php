<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RwController;
use App\Http\Controllers\RtController;
use App\Http\Controllers\AnggotaLembagaController;
use App\Models\Warga;

// Explicit route model binding untuk Warga
Route::bind('warga', function ($value) {
    return Warga::where('warga_id', $value)->firstOrFail();
});

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'index'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware(['checklogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::middleware(['checkrole:Admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('wargas', WargaController::class);
        Route::delete('wargas/{warga}/warga-files/{file}', [WargaController::class, 'deleteFile'])
            ->name('wargas.warga-files.destroy');
        Route::get('warga-files/{file}', [WargaController::class, 'serveFile'])
            ->name('wargas.files.serve');
        Route::resource('lembaga', LembagaDesaController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('perangkat_desa', \App\Http\Controllers\PerangkatDesaController::class);
        Route::resource('rw', RwController::class);
        Route::resource('rt', RtController::class);
        Route::resource('anggota-lembaga', AnggotaLembagaController::class);
    });
});