<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;
use App\Http\Controllers\JabatanController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('lembaga', \App\Http\Controllers\LembagaDesaController::class);Route::resource('wargas', \App\Http\Controllers\WargaController::class);
Route::resource('wargas', WargaController::class);

Route::resource('jabatan', JabatanController::class);