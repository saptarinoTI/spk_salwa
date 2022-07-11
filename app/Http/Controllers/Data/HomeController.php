<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\SiswaModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $siswaSD = SiswaModel::where('jenjang', 'sd')->get();
        $siswaSMP = SiswaModel::where('jenjang', 'smp')->get();
        $siswaSMA = SiswaModel::where('jenjang', 'sma')->get();

        return view('home.index', compact('siswaSD', 'siswaSMP', 'siswaSMA'));
    }
}
