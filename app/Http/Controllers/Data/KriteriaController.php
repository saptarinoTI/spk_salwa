<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\KriteriaModel;
use App\Models\NormalisasiModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        $kri = NormalisasiModel::all();
        $kriteriaNew = KriteriaModel::all();
        foreach ($kri as $key) {
            $c1 = $key->c1;
            $c2 = $key->c2;
            $c3 = $key->c3;
            $c4 = $key->c4;
            $c5 = $key->c5;
            $c6 = $key->c6;
            $c7 = $key->c7;
            $hasil = ($c1 * $kriteriaNew[0]['nilai']) + ($c2 * $kriteriaNew[1]['nilai']) + ($c3 * $kriteriaNew[2]['nilai']) + ($c4 * $kriteriaNew[3]['nilai']) + ($c5 * $kriteriaNew[4]['nilai']) + ($c6 * $kriteriaNew[5]['nilai']) + ($c7 * $kriteriaNew[6]['nilai']);
            $key->update([
                'hasil' => $hasil,
            ]);
        }
        return redirect()->route('kriteria.index');
    }
}
