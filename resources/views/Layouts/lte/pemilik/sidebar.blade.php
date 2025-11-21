<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <a href="{{ route('pemilik.dashboard') }}" class="brand-link">
      <img src="{{ asset('https://ftmm.unair.ac.id/wp-content/uploads/filr/13875/Logo%20UNAIR.png') }}" alt="RSHP Logo" class="brand-image opacity-75 shadow" />
      <span class="brand-text fw-light">RSHP</span>
    </a>
  </div>

  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" data-accordion="false">
        <li class="nav-item">
          <a href="{{ route('pemilik.dashboard') }}" class="nav-link {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <li class="nav-header">MENU UTAMA</li>

        <li class="nav-item">
          <a href="{{ route('pemilik.pets.index') }}" class="nav-link {{ request()->routeIs('pemilik.pets.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-card-list"></i>
            <p>Data Hewan Saya</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('pemilik.reservasi.index') }}" class="nav-link {{ request()->routeIs('pemilik.reservasi.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-calendar2-check"></i>
            <p>Daftar Reservasi</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('pemilik.rekam_medis.index') }}" class="nav-link {{ request()->routeIs('pemilik.rekam_medis.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-journal-medical"></i>
            <p>Daftar Rekam Medis</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('pemilik.profil.index') }}" class="nav-link {{ request()->routeIs('pemilik.profil.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-person-circle"></i>
            <p>Profil</p>
          </a>
        </li>

        <li class="nav-header">PENGATURAN</li>
        <li class="nav-item">
          <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="nav-icon bi bi-box-arrow-right"></i>
            <p>Logout</p>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">@csrf</form>
        </li>
      </ul>
    </nav>
  </div>
</aside>
<!--end::Sidebar-->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.has-treeview').forEach(function (li) {
    const submenu = li.querySelector('.nav-treeview');
    if (!submenu) return;
    if (!submenu.querySelector('.nav-link.active')) {
      submenu.classList.remove('show');
    } else {
      submenu.classList.add('show');
    }
  });

  document.querySelectorAll('.has-treeview > .nav-link').forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const parent = link.parentElement;
      const submenu = parent.querySelector('.nav-treeview');
      if (!submenu) return;
      const isOpen = submenu.classList.contains('show');
      document.querySelectorAll('.has-treeview .nav-treeview.show').forEach(function (open) {
        if (open !== submenu) open.classList.remove('show');
      });
      if (isOpen) submenu.classList.remove('show'); else submenu.classList.add('show');
    });
  });
});
</script>
@endpush
