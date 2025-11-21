<!doctype html>
<html lang="en">

@include('Layouts.lte.pemilik.head')

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
    <div class="app-wrapper">

        @include('Layouts.lte.pemilik.navbar')
        @include('Layouts.lte.pemilik.sidebar')

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

        @include('Layouts.lte.pemilik.footer')

    </div>



</body>

</html>
