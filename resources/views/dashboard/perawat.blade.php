@extends('layouts.lte.perawat.main')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold text-info">Dashboard Perawat</h1>
    <p class="text-muted">Halo Perawat, pantau aktivitas rawat jalan dan tindakan hari ini.</p>

    <div class="row">
        <div class="col-md-6">
            <div class="card mt-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-info">🧾 Data Perawatan</h5>
                    <p>Tugas harian Anda mencakup mempersiapkan pasien dan membantu dokter.</p>
                    <ul>
                        <li>Mempersiapkan ruang pemeriksaan</li>
                        <li>Mengecek jadwal pasien</li>
                        <li>Mengelola alat medis</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-3 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-info">📋 Menu</h5>
                    <p>Akses cepat ke fitur utama.</p>
                    <a href="{{ route('perawat.rekam_medis.index') }}" class="btn btn-primary me-2">Rekam Medis</a>
                    <a href="{{ route('perawat.kode_tindakan_terapi.index') }}" class="btn btn-secondary">Kode Tindakan Terapi</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
