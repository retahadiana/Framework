<!--begin::Sidebar-->
<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
  <!--begin::Sidebar Brand-->
  <div class="sidebar-brand">
    <!--begin::Brand Link-->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <!--begin::Brand Image-->
      <img
        src="{{ asset('https://ftmm.unair.ac.id/wp-content/uploads/filr/13875/Logo%20UNAIR.png') }}"
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
          <a href="{{ route('resepsionis.dashboard') }}" class="nav-link {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer2"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-header">MENU UTAMA</li>

        <!-- Registrasi Baru -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon bi bi-person-plus-fill"></i>
            <p>
              Registrasi Baru
              <i class="nav-arrow bi bi-chevron-right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('resepsionis.pemilik.create') }}" class="nav-link {{ request()->routeIs('resepsionis.pemilik.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-circle"></i>
                <p>Registrasi Pemilik</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('resepsionis.pet.create') }}" class="nav-link {{ request()->routeIs('resepsionis.pet.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-circle"></i>
                <p>Registrasi Pet</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Temu Dokter -->
        <li class="nav-item">
          <a href="{{ route('resepsionis.temu_dokter.index') }}" class="nav-link {{ request()->routeIs('resepsionis.temu_dokter.*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-calendar2-check-fill"></i>
            <p>Temu Dokter</p>
          </a>
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
