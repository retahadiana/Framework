<aside class="app-sidebar">
    <div class="sidebar-brand">
        <a href="/" class="brand-link">
            <img src="{{ asset('assets/img/lararshp-logo.png') }}" alt="LARARSHP Logo">
            <span class="brand-text">LARARSHP</span>
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav>
            <ul class="sidebar-menu" role="navigation" id="navigation">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/user" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-people"></i>
                        <p>Data User</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/role" class="nav-link {{ request()->is('role*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-shield-check"></i>
                        <p>Manajemen Role</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/pet" class="nav-link {{ request()->is('pet*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-heart"></i>
                        <p>Data Pet</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/pemilik" class="nav-link {{ request()->is('pemilik*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-person-lines-fill"></i>
                        <p>Data Pemilik</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kategori" class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-tags"></i>
                        <p>Data Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/jenis-hewan" class="nav-link {{ request()->is('jenis-hewan*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-paw"></i>
                        <p>Jenis Hewan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/ras-hewan" class="nav-link {{ request()->is('ras-hewan*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-patch-question"></i>
                        <p>Ras Hewan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kategori-klinis" class="nav-link {{ request()->is('data-kategori-klinis*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-clipboard-data"></i>
                        <p>Data Kategori Klinik</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/kode-tindakan-terapi" class="nav-link {{ request()->is('kode-tindakan-terapi*') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-activity"></i>
                        <p>Data Kode Tindakan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon bi bi-box-arrow-right"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

