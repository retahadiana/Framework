@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold text-warning">Dashboard Resepsionis</h1>
    <p class="text-muted">Selamat datang di sistem penerimaan pasien RSHP UNAIR.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning">👤 Registrasi Pemilik</h5>
                    <p class="card-text">Kelola data pemilik hewan peliharaan.</p>
                    <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-warning">Kelola Pemilik</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning">🐾 Registrasi Pet</h5>
                    <p class="card-text">Kelola data hewan peliharaan.</p>
                    <a href="{{ route('resepsionis.pet.index') }}" class="btn btn-warning">Kelola Pet</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-warning">📅 Atur Jadwal Temu Dokter</h5>
                    <p class="card-text">Kelola jadwal temu dokter untuk pasien.</p>
                    <a href="{{ route('resepsionis.temu_dokter.index') }}" class="btn btn-warning">Kelola Jadwal</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
