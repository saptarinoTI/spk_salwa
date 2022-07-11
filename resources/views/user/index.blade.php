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
      <h2 class="mb-1">Data Users</h2>
    </div>

  </div>

  <!--begin::Card body-->
  <div class="card-body py-4">
    <a href="{{ route('user.create') }}" data-state="0" id="add" class="btn btn-md btn-outline btn-outline-success btn-active-light-success me-2 hidex"><small>Add</small></a>

    {{-- 7771235312V451 --}}
    <div class="separator separator-dashed my-4"></div>

    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="dataxtbl" role="tabpanel">

        <div class="table-responsive">

          <table class="table table-row-bordered display nowrap" id="tblpenilaian" style="width:100%">
            <thead>
              <tr style="border-bottom: solid 1px #777">
                <th class="fw-bold" style="align-items: center; width: 5px !important;">#</th>
                <th class="fw-bold" width="70px">Username</th>
                <th class="fw-bold" width="70px">Nama</th>
                <th class="fw-bold" width="70px">Role</th>
                <th class="fw-bold" width="70px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @forelse ($users as $user)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ ucwords($user->username) }}</td>
                <td>{{ ucwords($user->nama) }}</td>
                <td>{{ ucwords($user->role) }}</td>
                <td>
                  <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-md btn-outline btn-outline-danger btn-active-light-danger me-2 hidex"><small>Delete</small></button>
                  </form>
                </td>
              </tr>
              @empty
              <tr class="text-center">
                <td colspan="5" class="fw-bolder">Data Tidak Tersedia</td>
              </tr>
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
