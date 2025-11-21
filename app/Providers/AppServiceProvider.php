<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share current dokter id with the dokter sidebar view so sidebar can link correctly
        View::composer('Layouts.lte.Dokter.sidebar', function ($view) {
            $currentDokterId = null;
            try {
                if (Auth::check()) {
                    $currentDokterId = Dokter::where('id_user', Auth::id())->value('id_dokter');
                }
            } catch (\Throwable $e) {
                // ignore errors and keep null
                $currentDokterId = null;
            }

            $view->with('currentDokterId', $currentDokterId);
        });
    }
}
