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
      <h2 class="mb-1">Tambah Data Siswa</h2>
    </div>

  </div>

  <!--begin::Card body-->
  <div class="card-body py-4">

    <form action="{{ route('pendaftaran.store') }}" method="POST">
      @csrf
      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Kode Pendaftaran</label>
        <div class="col-md-10">
          <input class="form-control form-control-solid @error('pendaftar') is-invalid @enderror" autocomplete="off" id="pendaftar" name="pendaftar" type="text" required>
          @error('pendaftar')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Jenjang</label>
        <div class="col-md-10">
          <select name="jenjang" id="jenjang" class="form-select form-select-solid s2x @error('jenjang') is-invalid @enderror">
            <option>Pilih salah satu ...</option>
            <option value="sd">Sekolah Dasar</option>
            <option value="smp">Sekolah Menegah Pertama</option>
            <option value="sma">Sekolah Menegah Atas</option>
          </select>
          @error('jenjang')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Kondisi Orang Tua</label>
        <div class="col-md-10">
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('penghasilan_ortu') is-invalid @enderror @error('kondisi_ortu') is-invalid @enderror" type="radio" name="kondisi_ortu" id="tidak_punya" value="1">
            <label class="form-check-label" for="tidak_punya">Tidak Punya</label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('penghasilan_ortu') is-invalid @enderror @error('kondisi_ortu') is-invalid @enderror" type="radio" name="kondisi_ortu" id="yatim/piatu" value="2">
            <label class="form-check-label" for="yatim/piatu">Yatim / Piatu</label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('penghasilan_ortu') is-invalid @enderror @error('kondisi_ortu') is-invalid @enderror" type="radio" name="kondisi_ortu" id="orang_tua_lengkap" value="3">
            <label class="form-check-label" for="orang_tua_lengkap">Orang Tua Lengkap</label>
            @error('kondisi_ortu')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Penghasilan Orang Tua/Wali</label>
        <div class="col-md-10">
          <input class="form-control form-control-solid @error('penghasilan_ortu') is-invalid @enderror" autocomplete="off" id="penghasilan_ortu" name="penghasilan_ortu" type="number" required>
          @error('penghasilan_ortu')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Kepemilikan Rumah</label>
        <div class="col-md-10">
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('kepemilikan_rmh') is-invalid @enderror" type="radio" name="kepemilikan_rmh" id="tidak_memiliki" value="1">
            <label class="form-check-label" for="tidak_memiliki">Tidak Memiliki</label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('kepemilikan_rmh') is-invalid @enderror" type="radio" name="kepemilikan_rmh" id="memiliki" value="2">
            <label class="form-check-label" for="memiliki">Memiliki</label>
            @error('kepemilikan_rmh')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Kepemilikan Harta</label>
        <div class="col-md-10">
          <input class="form-control form-control-solid @error('kepemilikan_hrt') is-invalid @enderror" autocomplete="off" id="kepemilikan_hrt" name="kepemilikan_hrt" type="number" required>
          @error('kepemilikan_hrt')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Pengeluaran Perbulan</label>
        <div class="col-md-10">
          <input class="form-control form-control-solid @error('pengeluaran_bln') is-invalid @enderror" autocomplete="off" id="pengeluaran_bln" name="pengeluaran_bln" type="number" required>
          @error('pengeluaran_bln')
          <div class="invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
      </div>

      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Hutang Bank</label>
        <div class="col-md-10">
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('hutang_bnk') is-invalid @enderror" type="radio" name="hutang_bnk" id="nol" value="1">
            <label class="form-check-label" for="nol">Rp. 0</label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('hutang_bnk') is-invalid @enderror" type="radio" name="hutang_bnk" id="satusampailima" value="2">
            <label class="form-check-label" for="satusampailima">Rp. 1-5.000.000</label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('hutang_bnk') is-invalid @enderror" type="radio" name="hutang_bnk" id="limasampaisepuluh" value="3">
            <label class="form-check-label" for="limasampaisepuluh">Rp. 5.000.001-10.000.000</label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('hutang_bnk') is-invalid @enderror" type="radio" name="hutang_bnk" id="sepuluhsampailimapuluh" value="4">
            <label class="form-check-label" for="sepuluhsampailimapuluh">Rp. 10.000.001-50.000.000 </label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('hutang_bnk') is-invalid @enderror" type="radio" name="hutang_bnk" id="lebihdarilimapuluh" value="5">
            <label class="form-check-label" for="lebihdarilimapuluh">Rp. >50.000.000</label>
            @error('hutang_bnk')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>


      <div class="form-group row fv-row mb-5">
        <label for="example-text-input" class="col-md-2 col-form-label">Hutang Lain</label>
        <div class="col-md-10">
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('hutang_lain') is-invalid @enderror" type="radio" name="hutang_lain" id="nol0" value="5">
            <label class="form-check-label" for="nol0">Rp. 0</label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('hutang_lain') is-invalid @enderror" type="radio" name="hutang_lain" id="satusampailima1" value="4">
            <label class="form-check-label" for="satusampailima1">Rp. 1-500.000 </label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('hutang_lain') is-invalid @enderror" type="radio" name="hutang_lain" id="limasampaisepuluh2" value="3">
            <label class="form-check-label" for="limasampaisepuluh2">Rp. 500.001-2.000.000</label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('hutang_lain') is-invalid @enderror" type="radio" name="hutang_lain" id="sepuluhsampailimapuluh3" value="2">
            <label class="form-check-label" for="sepuluhsampailimapuluh3">Rp. 2.000.001-5.000.000</label>
          </div>
          <div class="form-check form-check-inline form-check-solid">
            <input class="form-check-input @error('hutang_lain') is-invalid @enderror" type="radio" name="hutang_lain" id="lebihdarilimapuluh4" value="1">
            <label class="form-check-label" for="lebihdarilimapuluh4">Rp. >5.000.000</label>
            @error('hutang_lain')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>
      </div>


      <div class="separator separator-dashed my-4"></div>
      <div class="d-flex justify-content-end">
        <button type="reset" click="resetForm" class="btn btn-light btn-lg me-2 w-100 mb-5">Reset</button>
        <button type="submit" class="btn btn-lg btn-primary ms-2 w-100 mb-5">Save</button>
      </div>
    </form>

  </div>

</div>

@endsection
