<header>
    <div class="header-top">
        <div class="container @if(auth()->check() && in_array(strtolower(session('user_role_name', '')), ['administrator','dokter'])) admin-header @endif">
                    @if(auth()->check() && strtolower(session('user_role_name', '')) === 'administrator')
                        <div class="logo" style="display:inline-block;float:left;">
                            <a href="{{ route('dashboard.admin') }}">
                                <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo RSHP" style="max-height:56px;">
                            </a>
                        </div>
                    @endif
                <nav>
                    {{-- Role-specific navbar: admin or dokter --}} 
                    @if(auth()->check() && in_array(strtolower(session('user_role_name', '')), ['administrator','dokter'])) 
                        @php $role = strtolower(session('user_role_name', '')); @endphp
                        <ul class="admin-nav">
                            <li style="color:rgba(255,255,255,0.95);font-weight:600">Selamat datang, {{ ucfirst($role) }}</li>

                            @if($role === 'administrator')
                                @if(Route::has('dashboard'))
                                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                @endif
                                @if(Route::has('dashboard.admin'))
                                    <li><a href="{{ route('dashboard.admin') }}">Data Master</a></li>
                                @endif
                                @if(Route::has('layanan.index'))
                                    <li><a href="{{ route('layanan.index') }}">Layanan</a></li>
                                @endif
                            @elseif($role === 'dokter')
                                @if(Route::has('dashboard'))
                                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                @endif
                                @if(Route::has('dokter.rekam_medis.index'))
                                    <li><a href="{{ route('dokter.rekam_medis.index') }}">Rekam Medis</a></li>
                                @endif
                                @if(Route::has('dokter.kode_tindakan_terapi.index'))
                                    <li><a href="{{ route('dokter.kode_tindakan_terapi.index') }}">Kode Tindakan</a></li>
                                @endif
                                <li><a href="{{ url('/dokter/resep-obat') }}">Resep Obat</a></li>
                                <li><a href="{{ url('/dokter/pasien') }}">Data Pasien</a></li>
                            @endif

                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                                    @csrf
                                    <button type="submit" style="background:none;border:none;color:inherit;cursor:pointer;padding:0;margin:0;font:inherit">Logout</button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <ul>
                            <!-- Icon navigasi utama -->
                            <li>
                                <a href="{{ auth()->check() ? route('dashboard') : route('home') }}">
                                    <i class="fas fa-home"></i> Home
                                </a>
                            </li>
                            <li><a href="{{ url('/struktur-organisasi') }}"><i class="fas fa-users"></i> Struktur Organisasi</a></li>
                            <li><a href="{{ url('/layanan') }}"><i class="fas fa-stethoscope"></i> Layanan Umum</a></li>
                            <li><a href="{{ url('/visi-misi') }}"><i class="fas fa-bullseye"></i> Visi Misi dan Tujuan</a></li>
                            <li><a href="{{ url('/kontak') }}"><i class="fas fa-phone"></i> Kontak</a></li>
                            @guest
                                <li><a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                            @endguest
                            @auth
                                <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" style="display:inline">
                                        @csrf
                                        <button type="submit" style="background:none;border:none;color:inherit;cursor:pointer;padding:0;margin:0;font:inherit">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            @endauth
                        </ul>
                    @endif
                </nav>
            </div>
        </div>
        
        <!-- Logo RSHP UNAIR -->
        @unless(auth()->check() && in_array(strtolower(session('user_role_name', '')), ['administrator','dokter']))
        <div class="header-middle">
            <div class="logo">
                <img src="https://rshp.unair.ac.id/wp-content/uploads/2024/06/UNIVERSITAS-AIRLANGGA-scaled.webp" alt="Logo RSHP">
            </div>
        </div>
        @endunless
    </header>