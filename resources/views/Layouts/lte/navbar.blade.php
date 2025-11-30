@php
    $role = strtolower(session('user_role_name') ?? 'user');
    $userName = Auth::user()->nama ?? Auth::user()->name ?? '';
    $initials = '';
    if($userName){
        $parts = preg_split('/\s+/', trim($userName));
        $initials = strtoupper(substr($parts[0] ?? '', 0, 1) . (isset($parts[1]) ? substr($parts[1],0,1) : ''));
    }
    // Role-based primary link (dashboard or index) — use Route::has to avoid exceptions
    $primaryLink = '#';
    if($role === 'dokter' && \Route::has('dokter.dashboard')) $primaryLink = route('dokter.dashboard');
    elseif($role === 'perawat' && \Route::has('perawat.dashboard')) $primaryLink = route('perawat.dashboard');
    elseif($role === 'resepsionis' && \Route::has('resepsionis.dashboard')) $primaryLink = route('resepsionis.dashboard');
    elseif($role === 'pemilik' && \Route::has('pemilik.dashboard')) $primaryLink = route('pemilik.dashboard');
    elseif($role === 'administrator' && \Route::has('dashboard.admin')) $primaryLink = route('dashboard.admin');
@endphp

<style>
    .app-header.navbar { background: rgba(255,255,255,0.92); backdrop-filter: blur(6px); box-shadow:0 1px 0 rgba(0,0,0,0.04); }
    .app-header .nav-avatar{ width:36px; height:36px; display:inline-flex; align-items:center; justify-content:center; border-radius:50%; font-weight:700; color:#fff; background:linear-gradient(135deg,#0891b2,#3b82f6); }
    .app-header .navbar-badge{ font-size:0.65rem; padding:0.18rem 0.45rem; border-radius:10px; }
    .app-header .nav-link{ color: #333; }
    .app-header .user-menu .dropdown-menu{ min-width:220px; border-radius:12px; box-shadow:0 6px 20px rgba(0,0,0,0.08); }
    .app-header .search-input{ width:0; transition: width .18s ease; border-radius:20px; }
    .app-header .search-input.open{ width:220px; padding-left:10px; padding-right:10px; }
    .nav-link .bi{ font-size:1.05rem; }
    .status-updated{ animation: highlight .9s ease; }
    @keyframes highlight{ 0%{ transform:translateY(-2px); } 50%{ box-shadow:0 6px 18px rgba(11,100,138,0.08); } 100%{ transform:none; } }
    @media (max-width:768px){ .d-none.d-md-inline{ display:none !important; } }
</style>

<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>
            <li class="nav-item d-none d-md-block"><a href="{{ $primaryLink }}" class="nav-link">Home</a></li>
            <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
        </ul>

        <ul class="navbar-nav ms-auto align-items-center">
            <li class="nav-item me-2">
                <a class="nav-link" href="#" data-widget="navbar-search" title="Search">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            {{-- Messages (if component exists) --}}
            <li class="nav-item dropdown me-2">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-chat-text"></i>
                    <span class="navbar-badge badge text-bg-danger">3</span>
                </a>
                @includeIf('layouts.components.messages')
            </li>

            {{-- Notifications --}}
            <li class="nav-item dropdown me-2">
                <a class="nav-link" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="navbar-badge badge text-bg-warning">15</span>
                </a>
                @includeIf('layouts.components.notifications')
            </li>

            <li class="nav-item me-2">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen" title="Fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
                </a>
            </li>

            {{-- Quick logout button --}}
            <li class="nav-item me-2">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link p-0" style="border:0; background:transparent; color:inherit;">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </li>

            {{-- User Menu (consistent) --}}
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                    <span class="nav-avatar">{{ $initials ?: 'U' }}</span>
                    <span class="d-none d-md-inline">{{ $userName ?: ucfirst($role) }}</span>
                </a>
                @includeIf('layouts.components.user-menu')
            </li>
        </ul>
    </div>
</nav>