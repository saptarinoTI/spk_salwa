@extends('layout.app')


@section('panelhead')
<div class="page-title d-flex flex-column me-3">
  <h1 class="d-flex text-white fw-bolder my-1 fs-3">Data Kriteria</h1>
  <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-white opacity-75">
      <a href="." class="text-white text-hover-primary small">Home</a>
    </li>
    <li class="breadcrumb-item">
      <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-white opacity-75 small">Data Kriteria</li>
  </ul>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-header border-0 pt-6">
    <!--begin::Card title-->
    <div class="card-title flex-column">
      <h2 class="mb-1">Data Kriteria</h2>
    </div>

  </div>

  <!--begin::Card body-->
  <div class="card-body py-4">

    {{-- 7771235312V451 --}}
    <div class="separator separator-dashed my-4"></div>

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

        <div class="table-responsive">

          <table class="table table-row-bordered display nowrap" id="tblpenilaian" style="width:100%">
            <thead>
              <tr>
                <th class="fw-bold" style="align-items: center; width: 5px !important;">#</th>
                <th class="fw-bold" width="70px">Nama Kriteria</th>
                <th class="fw-bold" width="70px">Nilai Kepentingan</th>
                <th class="fw-bold" width="70px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($daftarKri as $p)
              <tr>
                <td>{{ ucwords($p->kode) }}</td>
                <td>{{ ucwords($p->nama) }}</td>
                <td>{{ ($p->nilai * 100) }} %</td>
                <td>
                  <a href="{{ route('kriteria.edit', $p->kode) }}" data-state="0" id="edit" class="btn btn-md btn-outline btn-outline-warning btn-active-light-warning me-2 hidex"><small>Edit</small></a>
                </td>
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
