<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\LembagaDesaController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('lembaga', \App\Http\Controllers\LembagaDesaController::class);Route::resource('wargas', \App\Http\Controllers\WargaController::class);
Route::resource('wargas', WargaController::class);
