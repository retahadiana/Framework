@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold text-secondary">Dashboard Pemilik</h1>
    <p class="text-muted">Selamat datang, pantau status hewan peliharaan Anda di sini.</p>

    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-secondary">🐶 Data Hewan Anda</h5>
            <table class="table table-hover">
                <thead>
                    <tr><th>Nama Hewan</th><th>Jenis</th><th>Status Pemeriksaan</th></tr>
                </thead>
                <tbody>
                    <tr><td>Snowy</td><td>Kucing</td><td>Sudah Diperiksa</td></tr>
                    <tr><td>Bruno</td><td>Anjing</td><td>Menunggu Jadwal</td></tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
