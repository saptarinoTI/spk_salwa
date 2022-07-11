<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\NormalisasiModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PeringkatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dataPendaftar = [];
        return view('peringkat.index', compact('dataPendaftar'));
    }

    public function filter(Request $request, NormalisasiModel $normal)
    {
        if ($request->jenjang) {
            $reqJen = $request->input('jenjang');
            $reqThn = $request->input('tahun');
            if ($request->tahun) {
                $dataPendaftar = $normal->whereHas('siswa', function (Builder  $query) use ($reqJen, $reqThn) {
                    return $query->where('jenjang', $reqJen)->where('tahun', $reqThn);
                })->orderBy('hasil', 'desc')->get();
                return view('peringkat.index', compact('dataPendaftar'));
            }
            $dataPendaftar = $normal->whereHas('siswa', function (Builder  $query) use ($reqJen) {
                return $query->where('jenjang', $reqJen);
            })->orderBy('hasil', 'desc')->get();
            return view('peringkat.index', compact('dataPendaftar'));
        } elseif ($request->tahun) {
            $dataPendaftar = $normal->where('tahun', $request->input('tahun'))
                ->orderBy('hasil', 'desc')->get();
            return view('peringkat.index', compact('dataPendaftar'));
        }
        $dataPendaftar = NormalisasiModel::orderBy('hasil', 'desc');
        return view('peringkat.index', compact('dataPendaftar'));
    }

    public function cetak(Request $request, NormalisasiModel $normal)
    {
        if ($request->jenjang) {
            $reqJen = $request->input('jenjang');
            $reqThn = $request->input('tahun');
            if ($request->tahun) {
                $dataPendaftar = $normal->whereHas('siswa', function (Builder  $query) use ($reqJen, $reqThn) {
                    return $query->where('jenjang', $reqJen)->where('tahun', $reqThn);
                })->orderBy('hasil', 'desc')->get();
                $pdf = PDF::loadview('peringkat.cetak', ['dataPendaftar' => $dataPendaftar]);
                return $pdf->download('laporan-peringkat-pdf');
            }
            $dataPendaftar = $normal->whereHas('siswa', function (Builder  $query) use ($reqJen) {
                return $query->where('jenjang', $reqJen);
            })->orderBy('hasil', 'desc')->get();
            $pdf = PDF::loadview('peringkat.cetak', ['dataPendaftar' => $dataPendaftar]);
            return $pdf->download('laporan-peringkat-pdf');
        } elseif ($request->tahun) {
            $dataPendaftar = $normal->where('tahun', $request->input('tahun'))
                ->orderBy('hasil', 'desc')->get();
            $pdf = PDF::loadview('peringkat.cetak', ['dataPendaftar' => $dataPendaftar]);
            return $pdf->download('laporan-peringkat-pdf');
        }
    }
}
