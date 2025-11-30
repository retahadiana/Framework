@php
    $role = strtolower(session('user_role_name') ?? 'user');
@endphp

@if($role === 'administrator')
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
                <li class="nav-item">
                  <a href="{{ route('dokter.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Dokter</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('perawat.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Perawat</p>
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
                  <a href="{{ route('temu_dokter.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Temu Dokter</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('datarekammedis.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Data Rekam Medis</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('kode-tindakan-terapi.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Kode Tindakan Terapi</p>
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
                    <p>Laporan Harian</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-circle"></i>
                    <p>Laporan Bulanan</p>
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

@elseif($role === 'dokter')
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
                @if(!empty($currentDokterId))
                  <a href="{{ route('dokter.profil.show', $currentDokterId) }}" class="nav-link">
                @else
                  <a href="{{ route('dokter.profil.create') }}" class="nav-link">
                @endif
                  <i class="nav-icon bi bi-person-circle"></i>
                  <p>Profil Dokter</p>
                </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
    <!--end::Sidebar Dokter-->

@elseif($role === 'perawat')
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
            @if(Route::has('perawat.profil.index'))
            <li class="nav-item">
              <a href="{{ route('perawat.profil.index') }}" class="nav-link">
                <i class="nav-icon bi bi-person"></i>
                <p>Profil Saya</p>
              </a>
            </li>
            @endif
          </ul>
        </nav>
      </div>
    </aside>
    <!--end::Sidebar Perawat-->

@elseif($role === 'pemilik')
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

@elseif($role === 'resepsionis')
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
            <!-- Daftar Pemilik (akses cepat untuk resepsionis) -->
            <li class="nav-item">
              <a href="{{ route('resepsionis.pemilik.index') }}" class="nav-link {{ request()->routeIs('resepsionis.pemilik.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-people"></i>
                <p>Daftar Pemilik</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('resepsionis.pet.index') }}" class="nav-link {{ request()->routeIs('resepsionis.pemilik.*') ? 'active' : '' }}">
                <i class="nav-icon bi bi-people"></i>
                <p>Daftar Pet</p>
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

@else
    <!-- Default Sidebar -->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
          <img src="{{ asset('https://ftmm.unair.ac.id/wp-content/uploads/filr/13875/Logo%20UNAIR.png') }}" alt="RSHP Logo" class="brand-image opacity-75 shadow" />
          <span class="brand-text fw-light">RSHP</span>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <ul class="nav sidebar-menu flex-column" role="navigation">
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link active">
                <i class="nav-icon bi bi-speedometer2"></i>
                <p>Dashboard</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>
@endif