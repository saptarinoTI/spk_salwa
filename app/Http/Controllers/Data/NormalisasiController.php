<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\NormalisasiModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;

class NormalisasiController extends Controller
{
    public function index()
    {
        $dataPendaftar = NormalisasiModel::all();
        return view('normalisasi.index', compact('dataPendaftar'));
    }
}
