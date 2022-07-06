<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\NormalisasiModel;
use App\Models\SiswaModel;
use Illuminate\Http\Request;

class PendaftaranSiswaController extends Controller
{
    public function index()
    {
        $pend = SiswaModel::all();
        return view('pendaftaran.index', compact('pend'));
    }

    public function create()
    {
        return view('pendaftaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "pendaftar" => "required",
            "jenjang" => "required|in:sd,smp,sma",
            "kondisi_ortu" => "required|in:1,2,3",
            "penghasilan_ortu" => "required|numeric",
            "kepemilikan_rmh" => "required|in:1,2",
            "kepemilikan_hrt" => "required|numeric",
            "pengeluaran_bln" => "required|numeric",
            "hutang_bnk" => "required|in:1,2,3,4,5",
            "hutang_lain" => "required|in:1,2,3,4,5",
        ]);

        $pendaftaran = new SiswaModel();
        $pendaftaran->pendaftar = strtolower(htmlspecialchars($request->pendaftar));
        $pendaftaran->jenjang = strtolower(htmlspecialchars($request->jenjang));
        $pendaftaran->kondisi_ortu = strtolower(htmlspecialchars($request->kondisi_ortu));
        $pendaftaran->penghasilan_ortu = strtolower(htmlspecialchars($request->penghasilan_ortu));
        $pendaftaran->kepemilikan_rmh = strtolower(htmlspecialchars($request->kepemilikan_rmh));
        $pendaftaran->kepemilikan_hrt = strtolower(htmlspecialchars($request->kepemilikan_hrt));
        $pendaftaran->pengeluaran_bln = strtolower(htmlspecialchars($request->pengeluaran_bln));
        $pendaftaran->hutang_bnk = strtolower(htmlspecialchars($request->hutang_bnk));
        $pendaftaran->hutang_lain = strtolower(htmlspecialchars($request->hutang_lain));
        $pendaftaran->tahun = date('Y');
        $pendaftaran->save();

        $dataPendaftar = SiswaModel::all();
        $c1 = [];
        $c2 = [];
        $c3 = [];
        $c4 = [];
        $c5 = [];
        $c6 = [];
        $c7 = [];
        foreach ($dataPendaftar as $pend) {
            array_push($c1, $pend['kondisi_ortu']);
            array_push($c2, $pend['penghasilan_ortu']);
            array_push($c3, $pend['kepemilikan_rmh']);
            array_push($c4, $pend['kepemilikan_hrt']);
            array_push($c5, $pend['pengeluaran_bln']);
            array_push($c6, $pend['hutang_bnk']);
            array_push($c7, $pend['hutang_lain']);
        }

        foreach ($dataPendaftar as $pend) {
            $newNormal = NormalisasiModel::where('siswa_id', $pend->id)->first();
            if ($newNormal == null) {
                $normal = new NormalisasiModel();
                $normal->siswa_id = $pend->id;
                $normal->c1 = ((float)(min($c1) / $pend['kondisi_ortu']));
                $normal->c2 = ((float)(min($c2)) / $pend['penghasilan_ortu']);
                $normal->c3 = ((float)(min($c3)) / $pend['kepemilikan_rmh']);
                $normal->c4 = ((float)(min($c4)) / $pend['kepemilikan_hrt']);
                $normal->c5 = ((float)(min($c5)) / $pend['pengeluaran_bln']);
                $normal->c6 = ((float)(min($c6)) / $pend['hutang_bnk']);
                $normal->c7 = ((float)(min($c7)) / $pend['hutang_lain']);
                $normal->hasil = ($normal->c1 * 0.2) + ($normal->c2 * 0.15) + ($normal->c3 * 0.15) + ($normal->c4 * 0.15) + ($normal->c5 * 0.15) + ($normal->c6 * 0.1) + ($normal->c7 * 0.1);
                $normal->save();
            } else {
                $newNormal->c1 = ((float)(min($c1) / $pend['kondisi_ortu']));
                $newNormal->c2 = ((float)(min($c2)) / $pend['penghasilan_ortu']);
                $newNormal->c3 = ((float)(min($c3)) / $pend['kepemilikan_rmh']);
                $newNormal->c4 = ((float)(min($c4)) / $pend['kepemilikan_hrt']);
                $newNormal->c5 = ((float)(min($c5)) / $pend['pengeluaran_bln']);
                $newNormal->c6 = ((float)(min($c6)) / $pend['hutang_bnk']);
                $newNormal->c7 = ((float)(min($c7)) / $pend['hutang_lain']);
                $newNormal->hasil = ($newNormal->c1 * 0.2) + ($newNormal->c2 * 0.15) + ($newNormal->c3 * 0.15) + ($newNormal->c4 * 0.15) + ($newNormal->c5 * 0.15) + ($newNormal->c6 * 0.1) + ($newNormal->c7 * 0.1);
                $newNormal->save();
            }
        }

        return redirect()->route('pendaftaran.index');
    }
}
