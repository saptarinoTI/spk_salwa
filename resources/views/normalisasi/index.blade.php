@extends('layout.app')


@section('panelhead')
<div class="page-title d-flex flex-column me-3">
  <h1 class="d-flex text-white fw-bolder my-1 fs-3">Data Normalisasi</h1>
  <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-white opacity-75">
      <a href="." class="text-white text-hover-primary small">Home</a>
    </li>
    <li class="breadcrumb-item">
      <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-white opacity-75 small">Data Normalisasi</li>
  </ul>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-header border-0 pt-6">
    <!--begin::Card title-->
    <div class="card-title flex-column">
      <h2 class="mb-1">Data Normalisasi</h2>
    </div>

    <form action="{{ route('normalisasi.filter') }}" method="post" class="d-flex">
      @csrf
      <select name="jenjang" id="jenjang" class="form-select form-select-solid s2x mx-2" required>
        <option value="">Pilih jenjang ...</option>
        <option value="sd">Sekolah Dasar</option>
        <option value="smp">Sekolah Menegah Pertama</option>
        <option value="sma">Sekolah Menegah Atas</option>
      </select>
      <select name="tahun" id="tahun" class="form-select form-select-solid s2x mx-2" required>
        <option value="">Pilih Tahun ...</option>
        @php
        for($i=date('Y'); $i>=date('Y')-2; $i-=1){
        echo "<option value='$i'> $i </option>";
        }
        @endphp
      </select>
      <button type="submit" class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex">Filter</button>
    </form>
  </div>

  <!--begin::Card body-->
  <div class="card-body py-4">

    <div class="d-flex">
      {{-- @if (Omjin::permission('penilaianCreate')) --}}
      {{-- <a href="{{ route('normalisasi.index') }}" data-state="0" id="add" class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex"><small>Save Data</small></a> --}}
      {{-- @endif --}}
    </div>
    {{-- 7771235312V451 --}}
    <div class="separator separator-dashed my-4"></div>

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

        <div class="table-responsive">

          <table class="table table-row-bordered display nowrap" id="tblpenilaian" style="width:100%">
            <thead>
              @if (!$dataPendaftar == [])
              <tr style="border-bottom: 1.3px solid rgb(50, 50, 50) !important">
                <th class="fw-bolder" width="1px">Kode Pendaftaran</th>
                <th class="fw-bolder" width="70px">C1</th>
                <th class="fw-bolder" width="70px">C2</th>
                <th class="fw-bolder" width="70px">C3</th>
                <th class="fw-bolder" width="70px">C4</th>
                <th class="fw-bolder" width="70px">C5</th>
                <th class="fw-bolder" width="70px">C6</th>
                <th class="fw-bolder" width="70px">C7</th>
                <th class="fw-bolder" width="70px">Preverensi</th>
              </tr>
              @endif
            </thead>
            <tbody>
              @forelse ($dataPendaftar as $pend)
              <tr>
                <td>{{ strtoupper($pend->siswa->pendaftar) }}</td>
                <td>{{ $pend->c1 }}</td>
                <td>{{ $pend->c2 }}</td>
                <td>{{ $pend->c3 }}</td>
                <td>{{ $pend->c4 }}</td>
                <td>{{ $pend->c5 }}</td>
                <td>{{ $pend->c6 }}</td>
                <td>{{ $pend->c7 }}</td>
                <td>{{ $pend->hasil }}</td>
              </tr>
              @empty
              @if (!$dataPendaftar == [])
              <tr class="text-center fw-bolder">
                <td colspan="9">Data Tidak Tersedia</td>
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
