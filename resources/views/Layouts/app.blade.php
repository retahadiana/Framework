<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Rumah Sakit Hewan Pendidikan UNAIR')</title>
    <!--  untuk mengimpor dan memuat font (jenis huruf) kustom dari layanan Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <!--  untuk menghubungkan halaman web dengan library ikon Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ==================== MODERN CSS VARIABLES ==================== */
        :root {
            /* Updated color palette */
            --primary-teal: #0891b2;
            --primary-teal-dark: #0e7490;
            --primary-teal-light: #06b6d4;
            --accent-blue: #3b82f6;
            --accent-orange: #f97316;
            --neutral-50: #f8fafc;
            --neutral-100: #f1f5f9;
            --neutral-200: #e2e8f0;
            --neutral-300: #cbd5e1;
            --neutral-400: #94a3b8;
            --neutral-500: #64748b;
            --neutral-600: #475569;
            --neutral-700: #334155;
            --neutral-800: #1e293b;
            --neutral-900: #0f172a;
            --white: #ffffff;
            --success: #10b981;
            --warning: #f59e0b;
            --error: #ef4444;
            
            /* menambahkan variabel jarak dan ukuran */
            --border-radius-sm: 0.5rem;
            --border-radius-md: 0.75rem;
            --border-radius-lg: 1rem;
            --border-radius-xl: 1.5rem;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        /* ==================== RESET & BASE STYLES ==================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
            font-size: 16px;
        }

        body {
            /* Diperbarui untuk style poppins menjadi font utama */
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.7;
            color: var(--neutral-700);
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--neutral-100) 100%);
            min-height: 100vh;
        }

        /* ==================== TAMPILAN TEKS ==================== */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: var(--neutral-900);
            line-height: 1.3;
            margin-bottom: 1rem;
        }

        h1 { 
            font-size: clamp(2rem, 5vw, 3rem); 
            font-weight: 700;
        }
        h2 { 
            font-size: clamp(1.5rem, 4vw, 2.25rem); 
            font-weight: 600;
        }
        
        h3 { 
            font-size: clamp(1.25rem, 3vw, 1.75rem); 
            font-weight: 600;
        }

        p { 
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            color: var(--neutral-600);
        }

        a {
            text-decoration: none;
            color: inherit;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* ==================== MODERN HEADER ==================== */
        header {
            background: var(--white);
            box-shadow: var(--shadow-lg);
            position: sticky;
            top: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
        }

        .header-top {
            /* Gradasi warna telah diperbarui menggunakan warna teal yang baru. */
            background: linear-gradient(135deg, var(--primary-teal) 0%, var(--primary-teal-dark) 100%);
            color: var(--white);
            padding: 1rem 0;
        }

        .header-top .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* When admin header is used, align logo left and nav right */
        .header-top .container.admin-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .header-top nav ul {
            list-style: none;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            justify-content: center;
        }

        .header-top nav ul li a {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            font-size: 0.95rem;
            border-radius: var(--border-radius-lg);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        /* Menambahkan efek hover modern dengan iko */
        .header-top nav ul li a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .header-top nav ul li a:hover::before {
            left: 100%;
        }

        .header-top nav ul li a:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Admin-specific navbar tweaks (compact, right-aligned, white links) */
        .header-top nav ul.admin-nav {
            display: flex;
            justify-content: flex-end;
            gap: 1.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
            align-items: center;
        }

        .header-top nav ul.admin-nav li a {
            color: var(--white);
            padding: 0.75rem 1rem;
            font-weight: 600;
        }

        .header-top nav ul.admin-nav li a:hover {
            background: rgba(255,255,255,0.08);
            border-radius: var(--border-radius-md);
        }

        .header-middle {
            padding: 2rem 2rem;
            text-align: center;
            background: var(--white);
        }

        .header-middle .logo {
            position: relative;
            display: inline-block;
        }

        .header-middle .logo img {
            max-height: 100px;
            width: auto;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
        }

        .header-middle .logo:hover img {
            transform: scale(1.05) rotate(1deg);
        }

        /* ==================== MODERN CONTAINER(mengatur lebar, padding, dan posisi konten) & SECTIONS transisi halus antarbagian, dan konsistensi grid. ==================== */
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .page-section {
            padding: 4rem 3rem;
            margin: 3rem auto;
            background: var(--white);
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-xl);
            max-width: 1200px;
            border: 1px solid var(--neutral-200);
            position: relative;
            overflow: hidden;
        }

        /* Added modern section decorative elements */
        .page-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-teal), var(--accent-blue), var(--accent-orange));
        }

        .page-section h2 {
            color: var(--primary-teal);
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        /* Enhanced section headers with icons */
        .page-section h2::before {
            content: '';
            width: 4px;
            height: 3rem;
            background: linear-gradient(180deg, var(--accent-orange), var(--primary-teal));
            border-radius: 2px;
        }

        .page-section h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-orange), var(--accent-blue));
            border-radius: 2px;
        }

        .page-section h3 {
            color: var(--primary-teal-dark);
            margin: 2.5rem 0 1.5rem 0;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* Menambahkan ikon pada elemen h3 */
        .page-section h3::before {
            content: '▶';
            color: var(--accent-orange);
            font-size: 0.8em;
        }

        .page-section ul {
            list-style: none;
            padding-left: 0;
            display: grid;
            gap: 1rem;
        }

        .page-section li {
            padding: 1rem 1.5rem;
            background: var(--neutral-50);
            border-radius: var(--border-radius-md);
            border-left: 4px solid var(--primary-teal);
            position: relative;
            line-height: 1.8;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-sm);
        }

        /* Item daftar (list) ditingkatkan tampilannya dengan gaya modern */
        .page-section li::before {
            /* content: '✓'; */
            position: absolute;
            left: -2px;
            top: 50%;
            transform: translateY(-50%);
            width: 24px;
            height: 24px;
            background: var(--primary-teal);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.8rem;
            box-shadow: var(--shadow-md);
        }

        .page-section li:hover {
            transform: translateX(8px);
            box-shadow: var(--shadow-md);
            background: var(--white);
        }

        /* ==================== MODERN HOME SECTION ==================== */
        .content-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 4rem;
            padding: 5rem 3rem;
            background: var(--white);
            margin: 3rem auto;
            max-width: 1400px;
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-xl);
            position: relative;
            overflow: hidden;
        }

        /* Added decorative background pattern (Hiasan Pola latar belakang)*/
        .content-container::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, var(--primary-teal-light) 0%, transparent 70%);
            opacity: 0.05;
            z-index: 0;
        }

        .content-container > * {
            position: relative;
            z-index: 1;
        }

        @media (min-width: 1024px) {
            .content-container {
                grid-template-columns: 1fr 1fr;
                align-items: center;
            }
        }

        .left-column {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .right-column {
            text-align: center;
        }

        /* ==================== Gaya tombol(Button) modern ==================== */
        .button-primary, .button-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            padding: 1.25rem 2.5rem;
            text-align: center;
            font-size: 1.1rem;
            font-weight: 600;
            border: none;
            border-radius: var(--border-radius-lg);
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        /* Added modern button animations and icons */
        .button-primary::before, .button-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s;
        }

        .button-primary:hover::before, .button-secondary:hover::before {
            left: 100%;
        }

        .button-primary {
            background: linear-gradient(135deg, var(--accent-orange) 0%, #ea580c 100%);
            color: var(--white);
        }

        .button-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 35px rgba(249, 115, 22, 0.4);
        }

        .button-secondary {
            background: linear-gradient(135deg, var(--accent-blue) 0%, #1d4ed8 100%);
            color: var(--white);
        }

        .button-secondary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 35px rgba(59, 130, 246, 0.4);
        }

        .text-block {
            font-size: 1.2rem;
            line-height: 1.9;
            color: var(--neutral-600);
            padding: 2rem;
            background: var(--neutral-50);
            border-radius: var(--border-radius-lg);
            border-left: 4px solid var(--primary-teal);
            box-shadow: var(--shadow-sm);
        }

        /* ==================== MODERN VIDEO CONTAINER(mengatur lebar, posisi, dan tata letak konten) ==================== */
        .video-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border-radius: var(--border-radius-xl);
            overflow: hidden;
            box-shadow: var(--shadow-xl);
            transition: transform 0.3s ease;
        }

        .video-container:hover {
            transform: scale(1.02);
        }

        .video-container iframe {
            width: 100%;
            height: 350px;
            border: none;
        }

        /* ==================== MODERN STRUKTUR ORGANISASI ==================== */
        .struktur-organisasi {
            padding: 5rem 3rem;
            text-align: center;
            background: var(--white);
            margin: 3rem auto;
            max-width: 1200px;
            border-radius: var(--border-radius-xl);
            box-shadow: var(--shadow-xl);
            position: relative;
            overflow: hidden;
        }

        /* Added decorative background */
        .struktur-organisasi::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, var(--primary-teal), var(--accent-blue), var(--accent-orange));
        }

        .struktur-organisasi h1 {
            margin-bottom: 4rem;
            color: var(--primary-teal);
            position: relative;
            padding-bottom: 1.5rem;
        }

        .struktur-organisasi h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 4px;
            background: linear-gradient(90deg, var(--accent-orange), var(--accent-blue));
            border-radius: 2px;
        }

        /* Enhanced direktur card with modern styling(shadow lembut, tipografi bersih, animasi hover, dan warna aksen modern) */
        .jabatan-direktur {
            margin-bottom: 5rem;
            padding: 3rem;
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--white) 100%);
            border-radius: var(--border-radius-xl);
            border: 2px solid var(--neutral-200);
            box-shadow: var(--shadow-lg);
            position: relative;
            transition: transform 0.3s ease;
        }

        .jabatan-direktur:hover { /* Animasi hover penyebab efek*/
            transform: translateY(-5px); /* Transform penyebab gerakan*/
        }

        .jabatan-direktur::before {
            content: '👑';
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--accent-orange);
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            box-shadow: var(--shadow-md);
        }

        .jabatan-direktur h2, .jabatan-wadir h2 {
            color: var(--primary-teal-dark);
            font-size: 1.4rem;
            margin-bottom: 2rem;
            font-weight: 600;
        }

        .jabatan-direktur img, .jabatan-wadir img {
            border-radius: 50%;
            width: 180px;
            height: 180px;
            object-fit: cover;
            margin: 1.5rem 0;
            border: 6px solid var(--accent-orange);
            box-shadow: var(--shadow-xl);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .jabatan-direktur img:hover, .jabatan-wadir img:hover {
            transform: scale(1.1) rotate(5deg);
            border-color: var(--primary-teal);
        }

        .jabatan-direktur b, .jabatan-wadir b {
            display: block;
            font-size: 1.3rem;
            color: var(--neutral-800);
            font-weight: 600;
            margin-top: 1.5rem;
            font-family: 'Poppins', sans-serif;
        }

        /* Enhanced wakil direktur cards with modern grid */
        .jabatan-wadir-container {
            display: grid;
            grid-template-columns: 1fr;
            gap: 3rem;
            margin-top: 3rem;
        }

        @media (min-width: 768px) {
            .jabatan-wadir-container {
                grid-template-columns: 1fr 1fr;
            }
        }

        .jabatan-wadir {
            padding: 3rem 2rem;
            background: linear-gradient(135deg, var(--neutral-50) 0%, var(--white) 100%);
            border-radius: var(--border-radius-xl);
            border: 2px solid var(--neutral-200);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-lg);
            position: relative;
            overflow: hidden;
        }

        .jabatan-wadir::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-teal), var(--accent-blue));
        }

        .jabatan-wadir:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-teal);
        }

        .jabatan-wadir h2 {
            position: relative;
            padding-bottom: 1.5rem;
            margin-bottom: 2rem;
        }

        .jabatan-wadir h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--accent-orange);
            border-radius: 2px;
        }

        /* ==================== RESPONSIVE DESIGN ==================== */
        @media (max-width: 1023px) {
            .container {
                padding: 0 1.5rem;
            }
            
            .page-section {
                margin: 2rem 1rem;
                padding: 3rem 2rem;
            }
            
            .content-container {
                padding: 3rem 2rem;
                margin: 2rem 1rem;
            }
            
            .struktur-organisasi {
                padding: 3rem 2rem;
                margin: 2rem 1rem;
            }
        }

        @media (max-width: 767px) {
            .header-top .container {
                padding: 0 1rem;
            }
            
            .header-top nav ul {
                justify-content: center;
                gap: 0.25rem;
            }
            
            .header-top nav ul li a {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
            
            .header-middle {
                padding: 1.5rem 1rem;
            }
            
            .header-bottom {
                padding: 1rem;
            }
            
            .header-bottom span {
                display: block;
                margin: 0.5rem 0;
                padding: 0.5rem;
                background: rgba(255, 255, 255, 0.1);
                border-radius: var(--border-radius-md);
            }
            
            .page-section {
                margin: 1.5rem 0.5rem;
                padding: 2rem 1.5rem;
            }
            
            .content-container {
                padding: 2rem 1.5rem;
                margin: 1.5rem 0.5rem;
                gap: 2rem;
            }
            
            .struktur-organisasi {
                padding: 2rem 1.5rem;
                margin: 1.5rem 0.5rem;
            }
            
            .button-primary, .button-secondary {
                width: 100%;
                margin-bottom: 1rem;
                padding: 1rem 2rem;
            }
            
            .jabatan-direktur {
                padding: 2rem 1.5rem;
            }
            
            .jabatan-wadir {
                padding: 2rem 1.5rem;
            }
            
            .video-container iframe {
                height: 250px;
            }
        }

        /* ==================== Efek tombol tab navigasi ==================== */
        a:focus, button:focus {
            outline: 3px solid var(--accent-blue);
            outline-offset: 2px;
            border-radius: var(--border-radius-sm);
        }

        /* Memberi animasi masuk (fade in + slide up) saat elemen pertama kali muncul di halaman. */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .page-section, .content-container, .struktur-organisasi {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Membuat garis tipis di atas halaman yang menunjukkan seberapa jauh pengguna sudah scroll (scroll progress bar). */
        .scroll-indicator {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-teal), var(--accent-blue), var(--accent-orange));
            transform-origin: left;
            transform: scaleX(0);
            z-index: 9999;
            transition: transform 0.3s ease;
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Added scroll progress indicator -->
    <div class="scroll-indicator" id="scrollIndicator"></div>
    
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

    <main>
        @yield('content')
    </main>

    <script>
        window.onscroll = function() {
            const scrollIndicator = document.getElementById("scrollIndicator");
            const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            const scrolled = (winScroll / height) * 100;
            if (scrollIndicator) {
                scrollIndicator.style.transform = `scaleX(${scrolled / 100})`;
            }
        };
    </script>
    @stack('scripts')
</body>
</html>