@extends('layout.app')

@section('panelhead')
<div class="page-title d-flex flex-column me-3">
  <h1 class="d-flex text-white fw-bolder my-1 fs-3">Dashboard</h1>
  <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-white opacity-75">
      <a href="." class="text-white text-hover-primary small">Home</a>
    </li>
  </ul>
</div>
@endsection


@section('content')

<div class="row">
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h5>Total Siswa SD</h5>
        <h1>{{ count($siswaSD) }}</h1>
        <h6 class="fw-light">Siswa</h6>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h5>Total Siswa SMP</h5>
        <h1>{{ count($siswaSMP) }}</h1>
        <h6 class="fw-light">Siswa</h6>
      </div>
    </div>
  </div>
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        <h5>Total Siswa SMA</h5>
        <h1>{{ count($siswaSMA) }}</h1>
        <h6 class="fw-light">Siswa</h6>
      </div>
    </div>
  </div>
</div>

<div class="card mt-5 my-2 py-2 px-3">
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

      <div class="table-responsive">

        <table class="table table-row-bordered display nowrap" id="tblpenilaian" style="width:100%">
          <thead>
            <tr>
              <th class="fw-bold ps-3" style="align-items: center; width: 5px !important;">#</th>
              <th class="fw-bold" width="70px">Kriteria</th>
              <th class="fw-bold" width="70px">Nama Kriteria</th>
              <th class="fw-bold" width="70px">Atribut</th>
              <th class="fw-bold" width="70px">Nilai Atribut</th>
            </tr>
          </thead>
          <tbody>
            {{-- 1 --}}
            <tr class="table-active">
              <td rowspan="3" class="fw-bold ps-3">1</td>
              <td rowspan="3" class="fw-bold">C1</td>
              <td rowspan="3">Kondisi Orang Tua</td>
              <td>Tidak Punya</td>
              <td>1</td>
            </tr>
            <tr class="table-active">
              <td class="ps-3">Yatim/Piatu</td>
              <td>2</td>
            </tr>
            <tr class="table-active">
              <td class="ps-3">Orang Tua Lengkap</td>
              <td>3</td>
            </tr>

            {{-- 2 --}}
            <tr>
              <td class="fw-bold ps-3">2</td>
              <td class="fw-bold">C2</td>
              <td>Penghasilan Orang Tua/Wali</td>
              <td class="ps-3">Menyesuaikan penghasilan dari Orang Tua/Wali</td>
              <td class="ps-3">Didapatkan dari Jumlah Penghasilan Orang Tua/Wali</td>
            </tr>

            {{-- 3 --}}
            <tr class="table-active">
              <td rowspan="2" class="fw-bold ps-3">3</td>
              <td rowspan="2" class="fw-bold">C3</td>
              <td rowspan="2">Kepemilikan Rumah</td>
              <td>Tidak Memiliki</td>
              <td>1</td>
            </tr>
            <tr class="table-active">
              <td class="ps-3">Memiliki</td>
              <td>2</td>
            </tr>

            {{-- 4 --}}
            <tr>
              <td class="fw-bold ps-3">4</td>
              <td class="fw-bold">C4</td>
              <td>Kepemilikan Harta</td>
              <td class="ps-3">Menyesuaikan kepemilikan harta dari responden</td>
              <td class="ps-3">Didapatkan dari perakiraanjumlah harta responden</td>
            </tr>

            {{-- 5 --}}
            <tr>
              <td class="fw-bold ps-3 table-active">5</td>
              <td class="fw-bold table-active">C5</td>
              <td class="table-active">Pengeluaran Perbulan</td>
              <td class="ps-3 table-active">Menyesuaikan pengeluaran perbulandari responden</td>
              <td class="ps-3 table-active">Didapatkan dari jumlahpengeluaran perbulanresponden</td>
            </tr>

            {{-- 6 --}}
            <tr>
              <td rowspan="5" class="fw-bold ps-3">6</td>
              <td rowspan="5" class="fw-bold">C6</td>
              <td rowspan="5">Hutang Bank</td>
              <td>Rp. 0</td>
              <td>1</td>
            </tr>
            <tr>
              <td class="ps-3">Rp. 1-5.000.000</td>
              <td>2</td>
            </tr>
            <tr>
              <td class="ps-3">Rp. 5.000.001-10.000.000</td>
              <td>3</td>
            </tr>
            <tr>
              <td class="ps-3">Rp. 10.000.001-50.000.000</td>
              <td>4</td>
            </tr>
            <tr>
              <td class="ps-3">Rp. >50.000.000</td>
              <td>5</td>
            </tr>

            {{-- 7 --}}
            <tr class="table-active">
              <td rowspan="5" class="fw-bold ps-3">7</td>
              <td rowspan="5" class="fw-bold">C7</td>
              <td rowspan="5">Hutang Lain</td>
              <td>Rp. 0</td>
              <td>5</td>
            </tr>
            <tr class="table-active">
              <td class="ps-3">Rp. 1-500.000</td>
              <td>4</td>
            </tr>
            <tr class="table-active">
              <td class="ps-3">Rp. 500.001-2.000.000</td>
              <td>3</td>
            </tr>
            <tr class="table-active">
              <td class="ps-3">Rp. 2.000.001-5.000.000</td>
              <td>2</td>
            </tr>
            <tr class="table-active">
              <td class="ps-3">Rp. >5.000.000</td>
              <td>1</td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')

@endsection
