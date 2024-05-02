<?php

use App\Http\Controllers\ControllerPeserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/register', function (Request $request) {
   return "daya";
});


Route::prefix('register')->name('register.')->group(function(){
    Route::get('/', [ControllerPeserta::class, 'display_data_register'])->name('display');
    Route::post('/', [ControllerPeserta::class, 'store_data_register'])->name('store');
});
