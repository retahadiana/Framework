<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="{{ asset('assets/img/AdminLTELogo.png') }}"
        alt="RSHP Logo"
        class="brand-image opacity-75 shadow"
      />
      <!--end::Brand Image-->
      <!--begin::Brand Text-->
      <span class="brand-text fw-light">RSHP</span>
      <!--end::Brand Text-->
    </a>
    <!--end::Brand Link-->
  </div>
  <!--end::Sidebar Brand-->
  <!--begin::Sidebar Wrapper-->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <!--begin::Sidebar Menu-->
      <ul
        class="nav sidebar-menu flex-column"
        data-lte-toggle="treeview"
        role="navigation"
        data-accordion="false"
      >
        <li class="nav-item menu-open">
          <a href="{{ route('dashboard.admin') }}" class="nav-link active">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-header">MENU UTAMA</li>
        @php
          $masterOpen = request()->is('jenis-hewan*') || request()->is('ras-hewan*') || request()->is('kategori*') || request()->is('kategori-klinis*');
        @endphp
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link {{ $masterOpen ? 'active' : '' }}">
            <i class="nav-icon bi bi-box-seam-fill"></i>
            <p>
              Master Data
              <i class="nav-arrow bi bi-chevron-right"></i>
              
            </p>
          </a>
          <ul class="nav nav-treeview {{ $masterOpen ? 'show' : '' }}">
            <li class="nav-item">
              <a href="{{ route('jenis-hewan.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Jenis Hewan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('ras-hewan.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Ras Hewan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('kategori.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Kategori</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('kategori-klinis.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Kategori Klinis</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-people-fill"></i>
            <p>
              Manajemen User
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('user.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>User</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('role.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Role</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-person-heart"></i>
            <p>
              Pemilik & Pet
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('pemilik.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Data Pemilik</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('pet.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Data Pet</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-calendar2-heart"></i>
            <p>
              Pelayanan
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Temu Dokter</p>
              </a>
            </li>
            <li class="nav-item">
              @if(Route::has('rekam_medis.index'))
              <a href="{{ route('rekam_medis.index') }}" class="nav-link">
              @else
              <a href="{{ url('admin/datarekammedis') }}" class="nav-link">
              @endif
                <i class="nav-icon bi bi-circle"></i>
                <p>Rekam Medis</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('kode-tindakan-terapi.index') }}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Tindakan Terapi</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">LAPORAN</li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-bar-chart-fill"></i>
            <p>
              Laporan
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Laporan Kunjungan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Laporan Tindakan</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <!--end::Sidebar Menu-->
    </nav>
  </div>
  <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
  // initialize collapse state for treeview menus
  document.querySelectorAll('.has-treeview').forEach(function (li) {
    const submenu = li.querySelector('.nav-treeview');
    if (!submenu) return;
    // hide by default unless a child link is active
    if (!submenu.querySelector('.nav-link.active')) {
      submenu.classList.remove('show');
    } else {
      submenu.classList.add('show');
    }
  });

  // attach click handler to parent links
  document.querySelectorAll('.has-treeview > .nav-link').forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const parent = link.parentElement;
      const submenu = parent.querySelector('.nav-treeview');
      if (!submenu) return;
      const isOpen = submenu.classList.contains('show');
      // close other open menus (accordion behavior)
      document.querySelectorAll('.has-treeview .nav-treeview.show').forEach(function (open) {
        if (open !== submenu) open.classList.remove('show');
      });
      if (isOpen) submenu.classList.remove('show'); else submenu.classList.add('show');
    });
  });
});
</script>
@endpush
