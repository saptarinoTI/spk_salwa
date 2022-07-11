<div class="menu-item me-lg-1">
  <a href="{{ route('app.index') }}" class="menu-link py-3">
    <span class="menu-title">Dashboard</span>
  </a>
</div>

<div class="menu-item me-lg-1">
  <a href="{{ route('pendaftaran.index') }}" class="menu-link py-3">
    <span class="menu-title">Data Siswa</span>
  </a>
</div>

<div class="menu-item me-lg-1">
  <a href="{{ route('normalisasi.index') }}" class="menu-link py-3">
    <span class="menu-title">Data Normalisasi</span>
  </a>
</div>

<div class="menu-item me-lg-1">
  <a href="{{ route('peringkat.index') }}" class="menu-link py-3">
    <span class="menu-title">Data Peringkat</span>
  </a>
</div>

<div class="menu-item me-lg-1">
  <a href="{{ route('kriteria.index') }}" class="menu-link py-3">
    <span class="menu-title">Data Kriteria</span>
  </a>
</div>

@if (Auth::user()->role == 'superadmin')
<div class="menu-item me-lg-1">
  <a href="{{ route('user.index') }}" class="menu-link py-3">
    <span class="menu-title">Data User Login</span>
  </a>
</div>
@endif

<div class="menu-item me-lg-1 ms-5">
  <a href="{{ route('logout') }}" class="btn btn-danger menu-link py-3">
    <span class="menu-title">Logout</span>
  </a>
</div>
