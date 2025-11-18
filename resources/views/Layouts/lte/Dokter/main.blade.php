<!doctype html>
<html lang="en">

@include('Layouts.lte.Dokter.head')

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">
        @include('Layouts.lte.Dokter.navbar')
        @include('Layouts.lte.Dokter.sidebar')

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard Dokter</li>
                    </ol>
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </main>

        @include('Layouts.lte.Dokter.footer')
    </div>

    @stack('scripts')
</body>
</html>
