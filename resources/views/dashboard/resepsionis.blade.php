@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold text-warning">Dashboard Resepsionis</h1>
    <p class="text-muted">Selamat datang di sistem penerimaan pasien RSHP UNAIR.</p>

    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-warning">📅 Data Pendaftaran</h5>
            <p>Anda dapat mengelola pendaftaran pasien baru, penjadwalan, dan konfirmasi janji temu.</p>
            <ul>
                <li><a href="{{ route('pendaftaran.index') }}">Daftar Pasien Baru</a></li>
                <li><a href="{{ route('jadwal.index') }}">Jadwal Pemeriksaan</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
