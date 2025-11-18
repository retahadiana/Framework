<!--begin::Sidebar Perawat-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <div class="sidebar-brand">
    <a href="{{ route('perawat.dashboard') }}" class="brand-link">
      <img src="https://ftmm.unair.ac.id/wp-content/uploads/filr/13875/Logo%20UNAIR.png" alt="RSHP Logo" class="brand-image opacity-75 shadow" />
      <span class="brand-text fw-light">RSHP</span>
    </a>
  </div>
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" role="navigation">
        @if(Route::has('perawat.dashboard'))
        <li class="nav-item">
          <a href="{{ route('perawat.dashboard') }}" class="nav-link active">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>Dashboard</p>
          </a>
        </li>
        @endif
        <li class="nav-header">MENU UTAMA</li>
        @if(Route::has('perawat.rekam_medis.index'))
        <li class="nav-item">
          <a href="{{ route('perawat.rekam_medis.index') }}" class="nav-link">
            <i class="nav-icon bi bi-file-earmark-medical"></i>
            <p>Rekam Medis</p>
          </a>
        </li>
        @endif
        @if(Route::has('perawat.kode_tindakan_terapi.index'))
        <li class="nav-item">
          <a href="{{ route('perawat.kode_tindakan_terapi.index') }}" class="nav-link">
            <i class="nav-icon bi bi-activity"></i>
            <p>Kode Tindakan Terapi</p>
          </a>
        </li>
        @endif
      </ul>
    </nav>
  </div>
</aside>
<!--end::Sidebar Perawat-->
