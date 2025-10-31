<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    // Routing utama aplikasi
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )

    // Middleware utama dan custom
    ->withMiddleware(function (Middleware $middleware): void {

        /**
         * ===================================================
         * 🧱 Global Middleware (jika diperlukan)
         * ===================================================
         * Contoh: middleware global untuk semua request web
         * 
         * $middleware->web([
         *     \App\Http\Middleware\EncryptCookies::class,
         *     \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
         *     \Illuminate\Session\Middleware\StartSession::class,
         *     \Illuminate\View\Middleware\ShareErrorsFromSession::class,
         *     \App\Http\Middleware\VerifyCsrfToken::class,
         *     \Illuminate\Routing\Middleware\SubstituteBindings::class,
         * ]);
         */

        /**
         * ===================================================
         * 🧩 Alias Middleware (Route Middleware)
         * ===================================================
         * Di sini kamu daftar semua middleware custom
         * seperti role-based access control (RBAC)
         */
        $middleware->alias([
            'auth'          => \App\Http\Middleware\Authenticate::class,
            'guest'         => \App\Http\Middleware\RedirectIfAuthenticated::class,

            // Custom Middleware Role RSHP
            'isAdmin'       => \App\Http\Middleware\IsAdministrator::class,
            'isDokter'      => \App\Http\Middleware\IsDokter::class,
            'isPerawat'     => \App\Http\Middleware\IsPerawat::class,
            'isResepsionis' => \App\Http\Middleware\IsResepsionis::class,
            'isPemilik'     => \App\Http\Middleware\IsPemilik::class,
        ]);
    })

    // Penanganan Exception / Error
    ->withExceptions(function (Exceptions $exceptions): void {
        /**
         * ===================================================
         * ⚠️ Handler Exception Kustom (Opsional)
         * ===================================================
         * Kamu bisa menambahkan logika khusus di sini,
         * misalnya ketika 403 Forbidden, redirect ke halaman tertentu
         * 
         * Contoh:
         * $exceptions->render(function (AuthorizationException $e, $request) {
         *     return redirect()->route('unauthorized.page');
         * });
         */
    })

    // Buat instance aplikasi Laravel
    ->create();
