<?php

use Illuminate\\Support\\Facades\\Route;
use App\\Http\\Controllers\\MataKuliahController;
use App\\Http\\Controllers\\AbsensiController;
Route::get('/', function () {
    return view('welcome');
});

Route::resource('mata-kuliah', MataKuliahController::class);
Route::get('/absensi', [AbsensiController::class, 'index'])-&gt;name('absensi.index');
Route::post('/absensi', [AbsensiController::class, 'store'])-&gt;name('absensi.store');