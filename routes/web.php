<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\admin\JenisHewanController;
use App\Http\Controllers\admin\RasHewanController;
use App\Http\Controllers\admin\KategoriController;
use App\Http\Controllers\admin\KategoriKlinisController;
use App\Http\Controllers\admin\KodeTindakanTerapiController;
use App\Http\Controllers\admin\PemilikController;
use App\Http\Controllers\admin\PetController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dashboard\AdminDashboardController;
use App\Http\Controllers\Dashboard\DokterDashboardController;
use App\Http\Controllers\Dashboard\PerawatDashboardController;
use App\Http\Controllers\Dashboard\ResepsionisDashboardController;
use App\Http\Controllers\Dashboard\PemilikDashboardController;

Auth::routes();
// Dashboard for authenticated users
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

// untuk landing page umum (sebelum login)
Route::get('/', function () {
    return view('LandingPage.home');
})->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.admin');

    // Data management routes for admin
    Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis_hewan.index');
    Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras_hewan.index');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori_klinis.index');
    Route::get('/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('kode_tindakan_terapi.index');
    Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
    Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
    Route::get('/role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
});

Route::middleware(['auth', 'isDokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterDashboardController::class, 'index'])
        ->name('dokter.dashboard');

    Route::get('/dokter/rekam-medis', 
        [App\Http\Controllers\dokter\RekamMedisController::class, 'index'])
    ->name('dokter.rekam_medis.index');

    Route::get('/dokter/rekam-medis/{rekam}', 
        [App\Http\Controllers\dokter\RekamMedisController::class, 'show'])
    ->name('dokter.rekam_medis.show');
});


Route::middleware(['auth', 'isPerawat'])->group(function () {
    Route::get('/perawat/dashboard', [PerawatDashboardController::class, 'index'])->name('perawat.dashboard');

    Route::get('/perawat/rekam-medis',
        [App\Http\Controllers\perawat\RekamMedisController::class, 'index'])
    ->name('perawat.rekam_medis.index');

    Route::get('/perawat/kode-tindakan-terapi',
        [App\Http\Controllers\perawat\KodeTindakanTerapiController::class, 'index'])
    ->name('perawat.kode_tindakan_terapi.index');
});

Route::middleware(['auth', 'isResepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [ResepsionisDashboardController::class, 'index'])->name('resepsionis.dashboard');

    Route::get('/resepsionis/pemilik', [App\Http\Controllers\resepsionis\PemilikController::class, 'index'])->name('resepsionis.pemilik.index');
    Route::get('/resepsionis/pet', [App\Http\Controllers\resepsionis\PetController::class, 'index'])->name('resepsionis.pet.index');
    Route::get('/resepsionis/temu-dokter', [App\Http\Controllers\resepsionis\TemuDokterController::class, 'index'])->name('resepsionis.temu_dokter.index');
});

Route::middleware(['auth', 'isPemilik'])->group(function () {
    Route::get('/dashboard/pemilik', [PemilikDashboardController::class, 'index'])->name('pemilik.dashboard');
});


Route::get("/layanan", [SiteController::class, 'layanan'])->name('layanan.index');
Route::get("/visi-misi", [SiteController::class, 'visi_misi']);
Route::get("/struktur-organisasi", [SiteController::class, 'struktur']);
Route::get("/kontak", [SiteController::class, 'kontak']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// (Removed duplicate admin route block) — admin routes are already declared above in the first admin middleware group.


