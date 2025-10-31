@extends('layouts.app')

@section('content')

    <div class="container mt-4">
    <h1 class="fw-bold text-success">Dashboard Dokter</h1>
    <p class="text-muted">Halo Dokter, berikut ringkasan aktivitas pemeriksaan hari ini.</p>

    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-success">🐾 Daftar Pemeriksaan</h5>
            <p>Berisi daftar pasien hewan yang akan diperiksa hari ini.</p>
            <table class="table table-striped">
                <thead>
                    <tr><th>Nama Hewan</th><th>Pemilik</th><th>Waktu</th><th>Status</th></tr>
                </thead>
                <tbody>
                    <tr><td>Kucing - Snowy</td><td>Rizky</td><td>09:30</td><td>Menunggu</td></tr>
                    <tr><td>Anjing - Bruno</td><td>Alya</td><td>10:00</td><td>Selesai</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div> 



    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-success">📋 Data Master</h5>
            <p class="card-text">Anda dapat melihat data terkait praktik dokter hewan.</p>
            <ul>
                <li><a href="{{ route('dokter.rekam_medis.index') }}">Rekam Medis</a></li>
                <li><a href="{{ route('dokter.kode_tindakan_terapi.index') }}">Kode Tindakan Terapi</a></li>
            </ul>
        </div>
    </div>


@endsection
