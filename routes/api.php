<?php

use App\Http\Controllers\ControllerPeserta;
use App\Http\Controllers\ControllerReview;
use App\Http\Controllers\ControllerNomorTampil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('register')->name('register.')->group(function(){
    Route::get('/', [ControllerPeserta::class, 'display_data_register'])->name('display');
    Route::post('/', [ControllerPeserta::class, 'store_data_register'])->name('store');
});

Route::prefix('penilaian')->name('penilaian.')->group(function(){
    Route::post('/', [ControllerReview::class, 'hitung'])->name('hitung');
});

Route::prefix('updateStatus')->name('updateStatus.')->group(function(){
    Route::post('/', [ControllerNomorTampil::class, 'updated_status'])->name('updateStatus');
});

Route::prefix('updateDash')->name('updateDash.')->group(function(){
    Route::post('/', [ControllerReview::class, 'dash_setting_updated'])->name('dash_setting_updated');
});

