@extends('layout.app')


@section('panelhead')
<div class="page-title d-flex flex-column me-3">
  <h1 class="d-flex text-white fw-bolder my-1 fs-3">Data Users</h1>
  <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <li class="breadcrumb-item text-white opacity-75">
      <a href="." class="text-white text-hover-primary small">Home</a>
    </li>
    <li class="breadcrumb-item">
      <span class="bullet bg-white opacity-75 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-white opacity-75 small">Data Users Login</li>
  </ul>
</div>
@endsection

@section('content')
<div class="card">
  <div class="card-header border-0 pt-6">
    <!--begin::Card title-->
    <div class="card-title flex-column">
      <h2 class="mb-1">Tambah Data Users</h2>
    </div>

  </div>

  <!--begin::Card body-->
  <div class="card-body py-4">

    <form action="{{ route('user.store') }}" method="POST">
      @csrf
      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Username</label>
        <div class="col-md-10">
          <input class="form-control form-control-solid @error('username') is-invalid @enderror" autocomplete="off" id="username" name="username" type="text" required>
          @error('username')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Nama</label>
        <div class="col-md-10">
          <input class="form-control form-control-solid @error('nama') is-invalid @enderror" autocomplete="off" id="nama" name="nama" type="text" required>
          @error('nama')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Role</label>
        <div class="col-md-10">
          <select name="role" id="role" class="form-select form-select-solid s2x @error('role') is-invalid @enderror">
            <option>Pilih salah satu ...</option>
            <option value="admin">Admin</option>
            <option value="manager">Manager</option>
          </select>
          @error('role')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="separator separator-dashed my-4"></div>
      <div class="d-flex justify-content-end">
        <a href="{{ route('user.index') }}" click="resetForm" class="btn btn-light btn-lg me-2 w-100 mb-5">Kembali</a>
        <button type="submit" class="btn btn-lg btn-primary ms-2 w-100 mb-5">Save</button>
      </div>
    </form>

  </div>

</div>

@endsection
