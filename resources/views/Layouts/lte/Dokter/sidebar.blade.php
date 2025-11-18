<!--begin::Sidebar Dokter-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <div class="sidebar-brand">
    <a href="{{ route('dokter.dashboard') }}" class="brand-link">
      <img src="https://ftmm.unair.ac.id/wp-content/uploads/filr/13875/Logo%20UNAIR.png" alt="RSHP Logo" class="brand-image opacity-75 shadow" />
      <span class="brand-text fw-light">RSHP</span>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" role="navigation">
        @if(Route::has('dokter.dashboard'))
        <li class="nav-item">
          <a href="{{ route('dokter.dashboard') }}" class="nav-link active">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @endif
        <li class="nav-header">MENU UTAMA</li>
        @if(Route::has('dokter.rekam_medis.index'))
        <li class="nav-item">
          <a href="{{ route('dokter.rekam_medis.index') }}" class="nav-link">
            <i class="nav-icon bi bi-file-earmark-medical"></i>
            <p>Rekam Medis</p>
          </a>
        </li>
        @endif
        @if(Route::has('dokter.kode_tindakan_terapi.index'))
        <li class="nav-item">
          <a href="{{ route('dokter.kode_tindakan_terapi.index') }}" class="nav-link">
            <i class="nav-icon bi bi-activity"></i>
            <p>Kode Tindakan</p>
          </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="{{ url('/dokter/resep-obat') }}" class="nav-link">
            <i class="nav-icon bi bi-capsule"></i>
            <p>Resep Obat</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/dokter/pasien') }}" class="nav-link">
            <i class="nav-icon bi bi-people"></i>
            <p>Data Pasien</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<!--end::Sidebar Dokter-->
