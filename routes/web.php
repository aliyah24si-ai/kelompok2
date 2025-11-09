<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('lembaga', \App\Http\Controllers\LembagaDesaController::class);