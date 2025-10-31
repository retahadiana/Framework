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
    Route::get('/dokter/dashboard', [DokterDashboardController::class, 'index'])->name('dokter.dashboard');

    // Data management routes for dokter
    Route::get('/dokter/rekam-medis', [App\Http\Controllers\dokter\RekamMedisController::class, 'index'])->name('dokter.rekam_medis.index');
    Route::get('/dokter/kode-tindakan-terapi', [App\Http\Controllers\dokter\KodeTindakanTerapiController::class, 'index'])->name('dokter.kode_tindakan_terapi.index');
});

Route::middleware(['auth', 'isPerawat'])->group(function () {
    Route::get('/perawat/dashboard', [PerawatDashboardController::class, 'index'])->name('perawat.dashboard');
});

Route::middleware(['auth', 'isResepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [ResepsionisDashboardController::class, 'index'])->name('resepsionis.dashboard');
});

Route::middleware(['auth', 'isPemilik'])->group(function () {
    Route::get('/pemilik/dashboard', [PemilikDashboardController::class, 'index'])->name('pemilik.dashboard');
});


Route::get("/layanan", [SiteController::class, 'layanan'])->name('layanan.index');
Route::get("/visi-misi", [SiteController::class, 'visi_misi']);
Route::get("/struktur-organisasi", [SiteController::class, 'struktur']);
Route::get("/kontak", [SiteController::class, 'kontak']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// (Removed duplicate admin route block) — admin routes are already declared above in the first admin middleware group.


