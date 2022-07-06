<?php

use App\Http\Controllers\Data\HomeController;
use App\Http\Controllers\Data\KriteriaController;
use App\Http\Controllers\Data\NormalisasiController;
use App\Http\Controllers\Data\PendaftaranSiswaController;
use App\Http\Controllers\Data\PeringkatController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', [HomeController::class, 'login'])->name('login');

Route::prefix('app')->group(function () {
    // Pendaftaran Siswa
    // Route::get('/pendaftaran', [PendaftaranSiswaController::class, 'index'])->name('pendaftaran.index');
    // Route::get('/pendaftaran/create', [PendaftaranSiswaController::class, 'create'])->name('pendaftaran.create');
    // Route::post('/pendaftaran', [PendaftaranSiswaController::class, 'store'])->name('pendaftaran.store');

    Route::get('home', [HomeController::class, 'index'])->name('app.index');
    Route::resources([
        'pendaftaran' => PendaftaranSiswaController::class,
        'kriteria' => KriteriaController::class,
    ]);
    Route::get('normalisasi', [NormalisasiController::class, 'index'])->name('normalisasi.index');
    Route::get('peringkat', [PeringkatController::class, 'index'])->name('peringkat.index');
});
