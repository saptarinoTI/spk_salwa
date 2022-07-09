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
      <h2 class="mb-1">Tambah Data Kriteria</h2>
    </div>

  </div>

  <!--begin::Card body-->
  <div class="card-body py-4">

    <form action="{{ route('kriteria.update', $kriteria->kode) }}" method="POST">
      @csrf
      @method('patch')
      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Kriteria</label>
        <div class="col-md-10">
          <input class="form-control form-control-solid @error('kode') is-invalid @enderror" autocomplete="off" id="kode" name="kode" type="text" required value="{{ ucwords($kriteria->kode) }}" readonly>
          @error('kode')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Nama Kriteria</label>
        <div class="col-md-10">
          <input class="form-control form-control-solid @error('nama') is-invalid @enderror" autocomplete="off" id="nama" name="nama" type="text" required readonly value="{{ ucwords($kriteria->nama) }}">
          @error('nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Nilai Kepentingan</label>
        <div class="col-md-9">
          <input class="form-control form-control-solid @error('nilai') is-invalid @enderror" autocomplete="off" id="nilai" name="nilai" type="number" required value="{{ $kriteria->nilai * 100}}">
          @error('nilai')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="col-md-1">
          <h3>%</h3>
        </div>
      </div>


      <div class="separator separator-dashed my-4"></div>
      <div class="d-flex justify-content-end">
        <a href="{{ route('kriteria.index') }}" click="resetForm" class="btn btn-light btn-lg me-2 w-100 mb-5">Kembali</a>
        <button type="submit" class="btn btn-lg btn-primary ms-2 w-100 mb-5">Save</button>
      </div>
    </form>

  </div>

</div>

@endsection
