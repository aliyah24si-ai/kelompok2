<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\JabatanController;
use App\Http\Middleware\CheckIsLogin;
use App\Http\Middleware\CheckRole;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'index'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware([CheckIsLogin::class])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('wargas.index');
    })->name('dashboard');

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::middleware([CheckRole::class . ':admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('wargas', WargaController::class);
        Route::delete('wargas/{warga}/warga-files/{file}', [WargaController::class, 'deleteFile'])
            ->name('wargas.warga-files.destroy');
        Route::resource('lembaga', LembagaDesaController::class);
        Route::resource('jabatan', JabatanController::class);
        Route::resource('perangkat_desa', \App\Http\Controllers\PerangkatDesaController::class);
    });
});