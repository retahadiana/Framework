@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="fw-bold text-primary">Selamat datang di Dashboard Admin</h1>
    <p class="text-muted">Halo, {{ auth()->user()->email }}!</p>

    <div class="card mt-3 shadow-sm">
        <div class="card-body">
            <h5 class="card-title text-primary">📋 Data Master</h5>
            <p class="card-text">Anda dapat melihat seluruh data master seperti data pengguna, hewan, dokter, dan layanan.</p>
            <ul>
                <li><a href="{{ route('user.index') }}">Data User</a></li>
                <li><a href="{{ route('pet.index') }}">Data Hewan</a></li>
                <li><a href="{{ route('jenis_hewan.index') }}">Jenis Hewan</a></li>
                <li><a href="{{ route('ras_hewan.index') }}">ras hewan</a></li>
                <li><a href="{{ route('kategori.index') }}">Kategori</a></li>
                <li><a href="{{ route('kategori_klinis.index') }}">Kategori Klinis</a></li>
                <li><a href="{{ route('kode_tindakan_terapi.index') }}">Kode Tindakan Terapi</a></li>
                <li><a href="{{ route('pemilik.index') }}">Data Pemilik</a></li>
                <li><a href="{{ route('role.index') }}">Data Role</a></li>
            </ul>
        </div>
    </div>
</div>
@endsection
