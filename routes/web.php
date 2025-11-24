<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
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

Route::middleware(['auth', \App\Http\Middleware\IsAdministrator::class])->group(function () {
    Route::prefix('pemilik')->name('pemilik.')->group(function () {
        Route::get('/', [PemilikController::class, 'index'])->name('index');
        Route::get('/create', [PemilikController::class, 'create'])->name('create');
        Route::post('/store', [PemilikController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PemilikController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [PemilikController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [PemilikController::class, 'destroy'])->name('destroy');
    });
    Route::resource('pet', PetController::class);
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.admin');

    // Data management routes for admin (grouped, with create & store)
    Route::prefix('jenis-hewan')->name('jenis-hewan.')->group(function () {
    Route::get('/', [JenisHewanController::class, 'index'])->name('index');
    Route::get('/create', [JenisHewanController::class, 'create'])->name('create');
    Route::post('/store', [JenisHewanController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [JenisHewanController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [JenisHewanController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [JenisHewanController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('ras-hewan')->name('ras-hewan.')->group(function () {
    Route::get('/', [RasHewanController::class, 'index'])->name('index');
    Route::get('/create', [RasHewanController::class, 'create'])->name('create');
    Route::post('/store', [RasHewanController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [RasHewanController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [RasHewanController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [RasHewanController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('kategori')->name('kategori.')->group(function () {
    Route::get('/', [KategoriController::class, 'index'])->name('index');
    Route::get('/create', [KategoriController::class, 'create'])->name('create');
    Route::post('/store', [KategoriController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [KategoriController::class, 'update'])->name('update');
    Route::get('/{id}/delete', [KategoriController::class, 'delete'])->name('delete');
    Route::delete('/{id}/destroy', [KategoriController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('kategori-klinis')->name('kategori-klinis.')->group(function () {
    Route::get('/', [KategoriKlinisController::class, 'index'])->name('index');
    Route::get('/create', [KategoriKlinisController::class, 'create'])->name('create');
    Route::post('/store', [KategoriKlinisController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [KategoriKlinisController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [KategoriKlinisController::class, 'update'])->name('update');
    Route::get('/{id}/delete', [KategoriKlinisController::class, 'delete'])->name('delete');
    Route::delete('/{id}/destroy', [KategoriKlinisController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('kode-tindakan-terapi')->name('kode-tindakan-terapi.')->group(function () {
    Route::get('/', [KodeTindakanTerapiController::class, 'index'])->name('index');
    Route::get('/create', [KodeTindakanTerapiController::class, 'create'])->name('create');
    Route::post('/store', [KodeTindakanTerapiController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [KodeTindakanTerapiController::class, 'update'])->name('update');
    Route::get('/{id}/delete', [KodeTindakanTerapiController::class, 'delete'])->name('delete');
    Route::delete('/{id}/destroy', [KodeTindakanTerapiController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/', [PemilikController::class, 'index'])->name('index');
    Route::get('/create', [PemilikController::class, 'create'])->name('create');
    Route::post('/store', [PemilikController::class, 'store'])->name('store');
    });
    Route::prefix('pet')->name('pet.')->group(function () {
    Route::get('/', [PetController::class, 'index'])->name('index');
    Route::get('/create', [PetController::class, 'create'])->name('create');
    Route::post('/store', [PetController::class, 'store'])->name('store');
    });
    Route::prefix('role')->name('role.')->group(function () {
    Route::get('/', [RoleController::class, 'index'])->name('index');
    Route::get('/{iduser}/create', [RoleController::class, 'create'])->name('create');
    Route::post('/{iduser}/store', [RoleController::class, 'store'])->name('store');
    });
    Route::prefix('user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{iduser}/edit', [UserController::class, 'edit'])->name('edit');
    Route::put('/{iduser}', [UserController::class, 'update'])->name('update');
    Route::get('/{iduser}/resetPassword', [UserController::class, 'showResetPassword'])->name('showResetPassword');
    Route::post('/{iduser}/resetPassword', [UserController::class, 'resetPassword'])->name('resetPassword');
    });
    // Admin routes for managing doctors
    Route::prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/', [App\Http\Controllers\DokterController::class, 'index'])->name('index');
    Route::get('/{id}/edit', [App\Http\Controllers\DokterController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\DokterController::class, 'update'])->name('update');
    });
    // Admin routes for managing nurses
    Route::prefix('perawat')->name('perawat.')->group(function () {
        Route::get('/', [App\Http\Controllers\PerawatController::class, 'index'])->name('index');
        Route::get('/{id}/edit', [App\Http\Controllers\PerawatController::class, 'edit'])->name('edit');
        Route::put('/{id}', [App\Http\Controllers\PerawatController::class, 'update'])->name('update');
    });
});

Route::middleware(['auth', 'isDokter'])->group(function () {
    Route::get('/dokter/dashboard', [DokterDashboardController::class, 'index'])
        ->name('dokter.dashboard');

    // Dokter profile view (show by id)
    // Dokter profile (current dokter) - redirect to specific ID
    Route::get('/dokter/profil', [App\Http\Controllers\dokter\DokterProfilController::class, 'index'])
    ->name('dokter.profil.index');

    // Create profile form + store
    Route::get('/dokter/profil/create', [App\Http\Controllers\dokter\DokterProfilController::class, 'create'])
        ->name('dokter.profil.create');
    Route::post('/dokter/profil', [App\Http\Controllers\dokter\DokterProfilController::class, 'store'])
        ->name('dokter.profil.store');

    // Dokter profile view (show by id)
    Route::get('/dokter/profil/{id}', [App\Http\Controllers\dokter\DokterProfilController::class, 'show'])
        ->name('dokter.profil.show');

    // Edit & update dokter profile
    Route::get('/dokter/profil/{id}/edit', [App\Http\Controllers\dokter\DokterProfilController::class, 'edit'])
        ->name('dokter.profil.edit');

    Route::put('/dokter/profil/{id}', [App\Http\Controllers\dokter\DokterProfilController::class, 'update'])
        ->name('dokter.profil.update');

    Route::get('/dokter/rekam-medis', 
        [App\Http\Controllers\dokter\RekamMedisController::class, 'index'])
    ->name('dokter.rekam_medis.index');

    Route::get('/dokter/rekam-medis/{rekam}', 
        [App\Http\Controllers\dokter\RekamMedisController::class, 'show'])
    ->name('dokter.rekam_medis.show');
    // Detail tindakan & terapi CRUD (dokter)
    Route::post('/dokter/rekam-medis/{idrekam}/detail', [App\Http\Controllers\dokter\RekamMedisController::class, 'storeDetail'])->name('dokter.rekam_medis.detail.store');
    Route::put('/dokter/rekam-medis/detail/{iddetail}', [App\Http\Controllers\dokter\RekamMedisController::class, 'updateDetail'])->name('dokter.rekam_medis.detail.update');
    Route::delete('/dokter/rekam-medis/detail/{iddetail}', [App\Http\Controllers\dokter\RekamMedisController::class, 'destroyDetail'])->name('dokter.rekam_medis.detail.destroy');
});


Route::middleware(['auth', 'isPerawat'])->group(function () {
    Route::get('/perawat/dashboard', [PerawatDashboardController::class, 'index'])->name('perawat.dashboard');

    Route::get('/perawat/rekam-medis',
        [App\Http\Controllers\perawat\RekamMedisController::class, 'index'])
    ->name('perawat.rekam_medis.index');

    // Create (tambah) form route for perawat — maps to renamed view `detail.blade.php`
    Route::get('/perawat/rekam-medis/create',
        [App\Http\Controllers\perawat\RekamMedisController::class, 'create'])
    ->name('perawat.rekam_medis.create');

    // Edit form and update routes for Rekam Medis (perawat)
    Route::get('/perawat/rekam-medis/{idrekam_medis}/edit',
        [App\Http\Controllers\perawat\RekamMedisController::class, 'edit'])
    ->name('perawat.rekam_medis.edit');

    Route::put('/perawat/rekam-medis/{idrekam_medis}',
        [App\Http\Controllers\perawat\RekamMedisController::class, 'update'])
    ->name('perawat.rekam_medis.update');

    // Add show/detail route for Rekam Medis (perawat)
    Route::get('/perawat/rekam-medis/{idrekam_medis}',
        [App\Http\Controllers\perawat\RekamMedisController::class, 'show'])
    ->name('perawat.rekam_medis.show');

    // Destroy route for perawat rekam medis (delete)
    Route::delete('/perawat/rekam-medis/{idrekam_medis}',
        [App\Http\Controllers\perawat\RekamMedisController::class, 'destroy'])
    ->name('perawat.rekam_medis.destroy');

    Route::get('/perawat/kode-tindakan-terapi',
        [App\Http\Controllers\perawat\KodeTindakanTerapiController::class, 'index'])
    ->name('perawat.kode_tindakan_terapi.index');

        // Store route for perawat rekam medis (handles POST from form)
        Route::post('/perawat/rekam-medis',
            [App\Http\Controllers\perawat\RekamMedisController::class, 'store'])
        ->name('perawat.rekam_medis.store');

        // Perawat profile routes (show current perawat or create profile)
        Route::get('/perawat/profil', [App\Http\Controllers\perawat\PerawatProfilController::class, 'index'])
            ->name('perawat.profil.index');

        Route::get('/perawat/profil/create', [App\Http\Controllers\perawat\PerawatProfilController::class, 'create'])
            ->name('perawat.profil.create');

        Route::post('/perawat/profil', [App\Http\Controllers\perawat\PerawatProfilController::class, 'store'])
            ->name('perawat.profil.store');

        Route::get('/perawat/profil/{id}', [App\Http\Controllers\perawat\PerawatProfilController::class, 'show'])
            ->name('perawat.profil.show');
        
        // Edit and update perawat profile
        Route::get('/perawat/profil/{id}/edit', [App\Http\Controllers\perawat\PerawatProfilController::class, 'edit'])
            ->name('perawat.profil.edit');

        Route::put('/perawat/profil/{id}', [App\Http\Controllers\perawat\PerawatProfilController::class, 'update'])
            ->name('perawat.profil.update');
});

Route::middleware(['auth', 'isResepsionis'])->group(function () {
    Route::get('/resepsionis/dashboard', [ResepsionisDashboardController::class, 'index'])->name('resepsionis.dashboard');

    Route::get('/resepsionis/pemilik', [App\Http\Controllers\resepsionis\PemilikController::class, 'index'])->name('resepsionis.pemilik.index');
    // Registrasi pemilik (resepsionis)
    Route::get('/resepsionis/pemilik/create', [App\Http\Controllers\resepsionis\PemilikController::class, 'create'])->name('resepsionis.pemilik.create');
    Route::post('/resepsionis/pemilik', [App\Http\Controllers\resepsionis\PemilikController::class, 'store'])->name('resepsionis.pemilik.store');
    Route::get('/resepsionis/pet', [App\Http\Controllers\resepsionis\PetController::class, 'index'])->name('resepsionis.pet.index');
    // Registrasi pet (resepsionis)
    Route::get('/resepsionis/pet/create', [App\Http\Controllers\resepsionis\PetController::class, 'create'])->name('resepsionis.pet.create');
    Route::post('/resepsionis/pet', [App\Http\Controllers\resepsionis\PetController::class, 'store'])->name('resepsionis.pet.store');
    // Temu dokter routes (resepsionis)
    Route::get('/resepsionis/temu-dokter', [App\Http\Controllers\resepsionis\TemuDokterController::class, 'index'])->name('resepsionis.temu_dokter.index');
    Route::post('/resepsionis/temu-dokter', [App\Http\Controllers\resepsionis\TemuDokterController::class, 'store'])->name('resepsionis.temu_dokter.store');
    Route::patch('/resepsionis/temu-dokter/{id}/diperiksa', [App\Http\Controllers\resepsionis\TemuDokterController::class, 'markAsDiperiksa'])->name('resepsionis.temu_dokter.check');
    Route::delete('/resepsionis/temu-dokter/{id}', [App\Http\Controllers\resepsionis\TemuDokterController::class, 'destroy'])->name('resepsionis.temu_dokter.destroy');
});

Route::middleware(['auth', 'isPemilik'])->group(function () {
    Route::get('/dashboard/pemilik', [PemilikDashboardController::class, 'index'])->name('pemilik.dashboard');
    // Daftar Rekam Medis for pemilik
    Route::get('/pemilik/rekam-medis', [App\Http\Controllers\Pemilik\DaftarRekamMedisController::class, 'index'])->name('pemilik.rekam_medis.index');
    Route::get('/pemilik/rekam-medis/{id}', [App\Http\Controllers\Pemilik\DaftarRekamMedisController::class, 'show'])->name('pemilik.rekam_medis.show');
    // Daftar Reservasi (pemilik)
    Route::get('/pemilik/reservasi', [App\Http\Controllers\Pemilik\DaftarReservasiController::class, 'index'])->name('pemilik.reservasi.index');
    // Data Pet Saya (pemilik)
    Route::get('/pemilik/pets', [App\Http\Controllers\Pemilik\DataPetSayaController::class, 'index'])->name('pemilik.pets.index');
    // Profil pemilik
    Route::get('/pemilik/profil', [App\Http\Controllers\Pemilik\ProfileController::class, 'index'])->name('pemilik.profil.index');
    Route::put('/pemilik/profil', [App\Http\Controllers\Pemilik\ProfileController::class, 'update'])->name('pemilik.profil.update');
});

Route::get("/layanan", [SiteController::class, 'layanan'])->name('layanan.index');
Route::get("/visi-misi", [SiteController::class, 'visi_misi']);
Route::get("/struktur-organisasi", [SiteController::class, 'struktur']);
Route::get("/kontak", [SiteController::class, 'kontak']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');



