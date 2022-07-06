<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\KriteriaModel;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $daftarKri = KriteriaModel::all();
        return view('kriteria.index', compact('daftarKri'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'kode' => 'required|unique:kriteria,kode',
            'nama' => 'required',
            'nilai' => 'required|numeric'
        ]);
        $newKriteria = (htmlspecialchars($request->nilai) / 100);
        $kriteria = new KriteriaModel();
        $kriteria->kode = strtolower(htmlspecialchars($request->kode));
        $kriteria->nama = strtolower(htmlspecialchars($request->nama));
        $kriteria->nilai = $newKriteria;
        $kriteria->save();
        return redirect()->route('kriteria.index');
    }
}
