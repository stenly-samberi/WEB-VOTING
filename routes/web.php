<?php

use App\Http\Controllers\ControllerDashboard;
use App\Http\Controllers\ControllerDataJemaat;
use App\Http\Controllers\ControllerGenreLagu;
use App\Http\Controllers\ControllerKategoriJemaat;
use App\Http\Controllers\ControllerKategoriLomba;
use App\Http\Controllers\ControllerPeserta;
use App\Http\Controllers\ControllerUser;
use Illuminate\Support\Facades\Route;

Route::get('dash', function () {
    // halaman dashboard
})->middleware('auth')->middleware('auth');

Route::get('/', function () {
    return view('html.logins');
})->name('login');

Route::get('logout', [ControllerUser::class, 'logout'])->name('logout');

Route::prefix('login')->name('login.')->group(function () {
    Route::get('/', [ControllerUser::class, 'index'])->name('index');
    Route::post('/', [ControllerUser::class, 'auth'])->name('auth');
});

Route::prefix('dash')->name('dash.')->group(function () {
    Route::get('/', [ControllerDashboard::class, 'index'])->name('index')->middleware('auth');
    Route::post('/', [ControllerDashboard::class, 'store'])->name('store')->middleware('auth');
    Route::delete('/{id}', [ControllerDashboard::class, 'destroy'])->name('destroy')->middleware('auth');
});

Route::prefix('peserta')->name('peserta.')->group(function () {
    Route::get('/', [ControllerPeserta::class, 'index'])->name('index')->middleware('auth');
    Route::post('/', [ControllerPeserta::class, 'store'])->name('store')->middleware('auth');
    Route::post('/', [ControllerPeserta::class, 'peserta_detail'])->name('detail')->middleware('auth');
    Route::delete('/{id}', [ControllerPeserta::class, 'destroy'])->name('destroy')->middleware('auth');
});

Route::prefix('kategori_lomba')->name('kategori_lomba.')->group(function () {
    Route::get('/', [ControllerKategoriLomba::class, 'index'])->name('index')->middleware('auth');
    Route::post('/', [ControllerKategoriLomba::class, 'store'])->name('store')->middleware('auth');
    Route::delete('/{id}', [ControllerKategoriLomba::class, 'destroy'])->name('destroy')->middleware('auth');
});

Route::prefix('data_jemaat')->name('data_jemaat.')->group(function () {
    Route::get('/', [ControllerDataJemaat::class, 'index'])->name('index')->middleware('auth');
    Route::post('/', [ControllerDataJemaat::class, 'store'])->name('store')->middleware('auth');
    Route::put('/', [ControllerDataJemaat::class, 'updated'])->name('updated')->middleware('auth');
    Route::delete('/{id}', [ControllerDataJemaat::class, 'destroy'])->name('destroy')->middleware('auth');
});

Route::post('/', [ControllerDataJemaat::class, 'edit'])->name('data_jemaat.edit')->middleware('auth');



Route::prefix('kategori_jemaat')->name('kategori_jemaat.')->group(function () {
    Route::get('/', [ControllerKategoriJemaat::class, 'index'])->name('index')->middleware('auth');
    Route::post('/', [ControllerKategoriJemaat::class, 'store'])->name('store')->middleware('auth');
    Route::delete('/{id}', [ControllerKategoriJemaat::class, 'destroy'])->name('destroy')->middleware('auth');
});

Route::prefix('genre_lagu')->name('genre_lagu.')->group(function () {
    Route::get('/', [ControllerGenreLagu::class, 'index'])->name('index')->middleware('auth');
    Route::post('/', [ControllerGenreLagu::class, 'store'])->name('store')->middleware('auth');
    Route::delete('/{id}', [ControllerGenreLagu::class, 'destroy'])->name('destroy')->middleware('auth');
});



