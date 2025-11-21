<!doctype html>
<html lang="en">

@include('Layouts.lte.resepsionis.head')

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">

        @include('Layouts.lte.resepsionis.navbar')
        @include('Layouts.lte.resepsionis.sidebar')

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">@yield('page-title')</li>
                    </ol>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>

        @include('Layouts.lte.resepsionis.footer')

    </div>

    <!-- Required JS -->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('build/assets/js/adminlte.min.js') }}"></script>

    @stack('scripts')

</body>

</html>
