<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\NormalisasiModel;
use Illuminate\Http\Request;

class PeringkatController extends Controller
{
    public function index()
    {
        $dataPendaftar = NormalisasiModel::orderBy('hasil', 'desc')->get();
        return view('peringkat.index', compact('dataPendaftar'));
    }
}
