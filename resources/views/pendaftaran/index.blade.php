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
      <form action="{{ route('pendaftaran.filter') }}" method="POST" class="d-flex">
        @csrf
        <select name="jenjang" id="jenjang" class="form-select form-select-solid s2x mx-2" required>
          <option value="">Jenjang</option>
          <option value="sd">Sekolah Dasar</option>
          <option value="smp">Sekolah Menegah Pertama</option>
          <option value="sma">Sekolah Menegah Atas</option>
        </select>
        <select name="tahun" id="tahun" class="form-select form-select-solid s2x mx-2" required>
          <option value="">Tahun</option>
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

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

        <div class="table-responsive">

          <table class="table table-row-bordered display nowrap" id="tblpenilaian" style="width:100%">
            <thead>
              @if (!$pend == [])
              <tr style="border-bottom: 1.3px solid rgb(50, 50, 50) !important">
                <th class="fw-bolder">Kode Pendaftaran</th>
                <th class="fw-bolder">Jenjang</th>
                <th class="fw-bolder">Kondisi Orang Tua</th>
                <th class="fw-bolder">Penghasilan Orang Tua/Wali</th>
                <th class="fw-bolder">Kepemilikan Rumah</th>
                <th class="fw-bolder">Kepemilikan Rumaha</th>
                <th class="fw-bolder">Pengeluaran Perbulan</th>
                <th class="fw-bolder">Hutang Bank</th>
                <th class="fw-bolder">Hutang Lain</th>
                <th class="fw-bolder">Tahun</th>
              </tr>
              @endif
            </thead>
            <tbody>
              @forelse ($pend as $p)
              <tr>
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
              @empty
              @if (!$pend == [])
              <tr class="text-center">
                <td colspan="11" class="text-center">Data Tidak Tersedia</td>
              </tr>
              @endif
              @endforelse
            </tbody>
          </table>

        </div>

      </div>
    </div>


  </div>
  <!--end::Card body-->
</div>


@endsection
