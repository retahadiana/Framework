<!--begin::Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title', 'Dashboard')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />

    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, fully accessible with WCAG 2.1 AA compliance." />

    <link rel="preload" href="{{ asset('build/assets/css/adminlte.css') }}" as="style" />

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        media="print" onload="this.media='all'">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="{{ asset('build/assets/css/adminlte.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css">

    <!-- Custom overrides for project (placed after adminlte to allow easy overrides) -->
    <link rel="stylesheet" href="{{ asset('build/assets/css/custom.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css">

    <!-- Resepsionis palette & small UI tweaks (RSHP) -->
    <style>
        :root{
            --rshp-primary: #0d6efd;
            --rshp-sidebar: #1b2b4a;
            --rshp-accent: #ff6b6b;
            --rshp-muted: #6c757d;
            --rshp-surface: #ffffff;
        }

        .text-rshp { color: var(--rshp-sidebar) !important; }
        .bg-rshp { background: linear-gradient(90deg,var(--rshp-primary),var(--rshp-accent)); color:#fff !important; }

        .card-modern { border-radius: .5rem; box-shadow: 0 8px 22px rgba(23,32,51,0.06); border: 1px solid rgba(10,20,40,0.04); }
        .card-modern .card-header { background: rgba(13,110,253,0.04); border-bottom: 1px solid rgba(0,0,0,0.03); }

        .btn-rshp { background: linear-gradient(90deg,var(--rshp-primary),var(--rshp-accent)); border:0; color:#fff; }
        .badge-soft { background: rgba(13,110,253,0.08); color: var(--rshp-sidebar); padding: .25rem .5rem; border-radius: .35rem; }
    </style>

    @stack('styles')
</head>
<!--end::Head-->
