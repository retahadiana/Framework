@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold text-info">Dashboard Perawat</h1>
    <p class="text-muted">Halo Perawat, pantau aktivitas rawat jalan dan tindakan hari ini.</p>

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
@endsection
