<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\SiswaModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $siswaSD = SiswaModel::where('jenjang', 'sd')->get();
        $siswaSMP = SiswaModel::where('jenjang', 'smp')->get();
        $siswaSMA = SiswaModel::where('jenjang', 'sma')->get();

        return view('home.index', compact('siswaSD', 'siswaSMP', 'siswaSMA'));
    }

    public function login()
    {
        return view('home.login');
    }
}
