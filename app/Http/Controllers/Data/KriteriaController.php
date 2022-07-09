<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\KriteriaModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $daftarKri = KriteriaModel::all();
        return view('kriteria.index', compact('daftarKri'));
    }

    public function edit($id)
    {
        $kriteria = KriteriaModel::findOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'nilai' => 'required|numeric'
        ]);
        $newKriteria = (htmlspecialchars($request->nilai) / 100);
        $kriteria = KriteriaModel::findOrFail($id);
        $kriteria->update([
            'nilai' => $newKriteria,
        ]);

        $pendaftaran = new SiswaModel();
        return redirect()->route('kriteria.index');
    }
}
