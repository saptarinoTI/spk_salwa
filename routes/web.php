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

Route::get('/', function () {
    return redirect('login');
});
Route::get('login', [HomeController::class, 'login'])->name('login');


Route::prefix('app')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('app.index');
    Route::post('pendaftaran/filter', [PendaftaranSiswaController::class, 'filter'])->name('pendaftaran.filter');
    Route::resources([
        'pendaftaran' => PendaftaranSiswaController::class,
        'kriteria' => KriteriaController::class,
    ]);

    Route::post('normalisasi/filter', [NormalisasiController::class, 'filter'])->name('normalisasi.filter');
    Route::get('normalisasi', [NormalisasiController::class, 'index'])->name('normalisasi.index');

    Route::post('peringkat/filter', [PeringkatController::class, 'filter'])->name('peringkat.filter');
    Route::get('peringkat', [PeringkatController::class, 'index'])->name('peringkat.index');
});
