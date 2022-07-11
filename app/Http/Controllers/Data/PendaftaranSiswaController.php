<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\KriteriaModel;
use App\Models\NormalisasiModel;
use App\Models\SiswaModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PendaftaranSiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pend = [];
        return view('pendaftaran.index', compact('pend'));
    }

    public function create()
    {
        return view('pendaftaran.create');
    }

    public function filter(Request $request, SiswaModel $siswa)
    {
        if ($request->jenjang) {

            if ($request->tahun) {
                $pend = $siswa->where('jenjang', $request->input('jenjang'))
                    ->where('tahun', $request->input('tahun'))
                    ->get();
                return view('pendaftaran.index', compact('pend'));
            }

            $pend = $siswa->where('jenjang', $request->input('jenjang'))->get();
            return view('pendaftaran.index', compact('pend'));
        } elseif ($request->tahun) {
            $pend = $siswa->where('tahun', $request->input('tahun'))
                ->get();
            return view('pendaftaran.index', compact('pend'));
        }

        $pend = SiswaModel::all();
        return view('pendaftaran.index', compact('pend'));
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
        $pendaftaran->kondisi_ortu = (int)(htmlspecialchars($request->kondisi_ortu));
        $pendaftaran->penghasilan_ortu = (int)(htmlspecialchars($request->penghasilan_ortu));
        $pendaftaran->kepemilikan_rmh = (int)(htmlspecialchars($request->kepemilikan_rmh));
        $pendaftaran->kepemilikan_hrt = (int)(htmlspecialchars($request->kepemilikan_hrt));
        $pendaftaran->pengeluaran_bln = (int)(htmlspecialchars($request->pengeluaran_bln));
        $pendaftaran->hutang_bnk = (int)(htmlspecialchars($request->hutang_bnk));
        $pendaftaran->hutang_lain = (int)(htmlspecialchars($request->hutang_lain));
        $pendaftaran->tahun = date('Y');
        $pendaftaran->save();

        $dataPendaftar = SiswaModel::where('jenjang', $pendaftaran->jenjang)->where('tahun', $pendaftaran->tahun)->get();
        $kriteriaNew = KriteriaModel::all();
        $c1 = $c2 = $c3 = $c4 = $c5 = $c6 = $c7 = [];
        foreach ($dataPendaftar as $data) {
            array_push($c1, $data['kondisi_ortu']);
            array_push($c2, $data['penghasilan_ortu']);
            array_push($c3, $data['kepemilikan_rmh']);
            array_push($c4, $data['kepemilikan_hrt']);
            array_push($c5, $data['pengeluaran_bln']);
            array_push($c6, $data['hutang_bnk']);
            array_push($c7, $data['hutang_lain']);
        }

        foreach ($dataPendaftar as $data) {
            // Get Data Normalisasi Sesuai Jenjang dan Tahun
            $normal = NormalisasiModel::where('siswa_id', $data->id)->whereHas('siswa', function (Builder $query) use ($data) {
                $query->where('jenjang', $data->jenjang)->where('tahun', $data->tahun);
            })->first();
            if ($normal) {
                $normal->c1 = min($c1) / $normal->c1;
                $normal->c2 = min($c2) / $normal->c2;
                $normal->c3 = min($c3) / $normal->c3;
                $normal->c4 = min($c4) / $normal->c4;
                $normal->c5 = min($c5) / $normal->c5;
                $normal->c6 = min($c6) / $normal->c6;
                $normal->c7 = min($c7) / $normal->c7;
                $normal->hasil = ($normal->c1 * $kriteriaNew[0]['nilai']) + ($normal->c2 * $kriteriaNew[1]['nilai']) + ($normal->c3 * $kriteriaNew[2]['nilai']) + ($normal->c4 * $kriteriaNew[3]['nilai']) + ($normal->c5 * $kriteriaNew[4]['nilai']) + ($normal->c6 * $kriteriaNew[5]['nilai']) + ($normal->c7 * $kriteriaNew[6]['nilai']);
                $normal->save();
            } else {
                $newNormal = new NormalisasiModel();
                $newNormal->siswa_id = $data['id'];
                $newNormal->c1 = min($c1) / $data['kondisi_ortu'];
                $newNormal->c2 = min($c2) / $data['penghasilan_ortu'];
                $newNormal->c3 = min($c3) / $data['kepemilikan_rmh'];
                $newNormal->c4 = min($c4) / $data['kepemilikan_hrt'];
                $newNormal->c5 = min($c5) / $data['pengeluaran_bln'];
                $newNormal->c6 = min($c6) / $data['hutang_bnk'];
                $newNormal->c7 = min($c7) / $data['hutang_lain'];
                $newNormal->hasil = ($newNormal->c1 * $kriteriaNew[0]['nilai']) + ($newNormal->c2 * $kriteriaNew[1]['nilai']) + ($newNormal->c3 * $kriteriaNew[2]['nilai']) + ($newNormal->c4 * $kriteriaNew[3]['nilai']) + ($newNormal->c5 * $kriteriaNew[4]['nilai']) + ($newNormal->c6 * $kriteriaNew[5]['nilai']) + ($newNormal->c7 * $kriteriaNew[6]['nilai']);
                $newNormal->save();
            }
        }
        return redirect()->route('pendaftaran.index');
    }
}
