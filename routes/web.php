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


Route::get('home', function () {
    return view('LandingPage.home');
})->name('home');

Route::get("/layanan", [SiteController::class, 'layanan']);
Route::get("/visi-misi", [SiteController::class, 'visi_misi']);
Route::get("/struktur-organisasi", [SiteController::class, 'struktur']);
Route::get("/kontak", [SiteController::class, 'kontak']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/cek-koneksi', function () {
    try {
        \DB::connection()->getPdo();
        return "✅ Koneksi ke database berhasil";
    } catch (\Exception $e) {
        return "❌ Gagal: " . $e->getMessage();
    }
});

// untuk mengarahkan ke controller JenisHewanController pada method index

Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis_hewan.index');
Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras_hewan.index');
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori_klinis.index');
Route::get('/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('kode_tindakan_terapi.index');
Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
Route::get('/role', [RoleController::class, 'index'])->name('role.index');
Route::get('/user', [UserController::class, 'index'])->name('user.index');
