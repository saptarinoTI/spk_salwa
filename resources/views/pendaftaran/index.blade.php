@extends('layout.app')


@section('panelhead')
<div class="page-title d-flex flex-column me-3">
  <h1 class="d-flex text-white fw-bolder my-1 fs-3">Data Siswa</h1>
  <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-white opacity-75">
      <a href="." class="text-white text-hover-primary small">Home</a>
    </li>
    <li class="breadcrumb-item">
      <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-white opacity-75 small">Data Siswa</li>
  </ul>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-header border-0 pt-6">
    <!--begin::Card title-->
    <div class="card-title flex-column">
      <h2 class="mb-1">Data Siswa</h2>
    </div>

  </div>

  <!--begin::Card body-->
  <div class="card-body py-4">

    <div class="d-flex justify-content-between">
      {{-- @if (Omjin::permission('penilaianCreate')) --}}
      <a href="{{ route('pendaftaran.create') }}" data-state="0" id="add" class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex"><small>Add</small></a>
      <form action="." method="get" class="d-flex">
        @csrf
        <select name="jenjang" id="jenjang" class="form-select form-select-solid s2x mx-2">
          <option>Pilih jenjang ...</option>
          <option value="sd">Sekolah Dasar</option>
          <option value="smp">Sekolah Menegah Pertama</option>
          <option value="sma">Sekolah Menegah Atas</option>
        </select>
        <select name="tahun" id="tahun" class="form-select form-select-solid s2x mx-2">
          <option>Pilih Tahun ...</option>
          @php
          for($i=date('Y'); $i>=date('Y')-2; $i-=1){
          echo "<option value='$i'> $i </option>";
          }
          @endphp
        </select>
        <button type="submit" class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex">Filter</button>
      </form>
      {{-- @endif --}}
    </div>
    {{-- 7771235312V451 --}}
    <div class="separator separator-dashed my-4"></div>

    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6" style="display:none;">
      <li class="nav-item">
        <a class="nav-link active" id="dataxtbl-tab" data-bs-toggle="tab" href="#dataxtbl">Link 1</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="formx-tab" data-bs-toggle="tab" href="#formx">Link 2</a>
      </li>
    </ul>

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

        <div class="table-responsive">

          <table class="table table-row-bordered display nowrap" id="tblpenilaian" style="width:100%">
            <thead>
              <tr>
                <th style="align-items: center; width: 5px !important;">#</th>
                <th width="1px">Kode Pendaftaran</th>
                <th width="70px">Jenjang</th>
                <th width="70px">Kondisi Orang Tua</th>
                <th width="70px">Penghasilan Orang Tua/Wali</th>
                <th width="70px">Kepemilikan Rumah</th>
                <th width="70px">Kepemilikan Rumaha</th>
                <th width="70px">Pengeluaran Perbulan</th>
                <th width="70px">Hutang Bank</th>
                <th width="70px">Hutang Lain</th>
                <th width="70px">Tahun</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pend as $p)
              <tr>
                <td>{{ $p->id }}</td>
                <td>{{ strtoupper($p->pendaftar) }}</td>
                <td>{{ strtoupper($p->jenjang) }}</td>
                <td>@if ($p->kondisi_ortu == 1)
                  Tidak Punya
                  @elseif ($p->kondisi_ortu == 2)
                  Yatim/Piatu
                  @elseif ($p->kondisi_ortu == 3)
                  Orang Tua Lengkap
                  @endif</td>
                <td>Rp. {{ number_format($p->penghasilan_ortu, 0, ',', '.' ) }}</td>
                <td>@if ($p->kepemilikan_rmh == 1)
                  Tidak Memiliki
                  @elseif ($p->kepemilikan_rmh == 2)
                  Memiliki
                  @endif</td>
                <td>Rp. {{ number_format($p->kepemilikan_hrt, 0, ',', '.' ) }}</td>
                <td>Rp. {{ number_format($p->pengeluaran_bln, 0, ',', '.' ) }}</td>
                <td>@if ($p->hutang_bnk == 1)
                  Rp. 0
                  @elseif($p->hutang_bnk == 2)
                  Rp. 1-5.000.000
                  @elseif($p->hutang_bnk == 3)
                  Rp. 5.000.001-10.000.000
                  @elseif($p->hutang_bnk == 4)
                  Rp. 10.000.001-50.000.000
                  @elseif($p->hutang_bnk == 5)
                  Rp. >50.000.000
                  @endif</td>
                <td>@if ($p->hutang_lain == 1)
                  Rp. >5.000.000
                  @elseif($p->hutang_lain == 2)
                  Rp. 2.000.001-5.000.000
                  @elseif($p->hutang_lain == 3)
                  Rp. 500.001-2.000.000
                  @elseif($p->hutang_lain == 4)
                  Rp. 1-500.000
                  @elseif($p->hutang_lain == 5)
                  Rp. 0
                  @endif</td>
                <td>{{ $p->tahun }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>

        </div>

      </div>
    </div>


  </div>
  <!--end::Card body-->
</div>


@endsection
