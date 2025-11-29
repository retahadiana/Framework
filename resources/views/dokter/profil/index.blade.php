@extends('Layouts.lte.main')

@section('title', 'Profil Dokter')

@section('content')
<div class="container page-section">
    <div style="display:flex;gap:1.5rem;align-items:center;">
        <div style="width:140px;height:140px;border-radius:12px;background:linear-gradient(135deg,#06b6d4,#0891b2);display:flex;align-items:center;justify-content:center;color:#fff;font-size:3rem;box-shadow:var(--shadow-md);">
            <i class="fa fa-user-md" aria-hidden="true"></i>
        </div>
        <div>
            <h2>Profil Dokter</h2>
            <p style="margin:0.25rem 0;color:var(--neutral-600);">ID: <strong>{{ $dokter->id_dokter ?? '-' }}</strong></p>
            <p style="margin:0.25rem 0;color:var(--neutral-600);">Nama: <strong>{{ $dokter->user->nama ?? ($dokter->id_user ?? '-') }}</strong></p>
        </div>
    </div>

    <hr style="margin:1.5rem 0;border:none;border-top:1px solid var(--neutral-200);">

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
        <div style="padding:1rem;border-radius:8px;background:var(--neutral-50);">
            <h3>Data Kontak</h3>
            <p><strong>Alamat</strong><br>{{ $dokter->alamat ?? '-' }}</p>
            <p><strong>No. HP</strong><br>{{ $dokter->no_hp ?? '-' }}</p>
        </div>

        <div style="padding:1rem;border-radius:8px;background:var(--neutral-50);">
            <h3>Spesialisasi & Lainnya</h3>
            <p><strong>Bidang</strong><br>{{ $dokter->bidang_dokter ?? '-' }}</p>
            <p><strong>Jenis Kelamin</strong><br>{{ $dokter->jenis_kelamin ?? '-' }}</p>
        </div>
    </div>

    <div style="margin-top:1.5rem;display:flex;gap:0.75rem;align-items:center;">
        <a href="{{ url()->previous() }}" class="button-secondary" style="padding:0.6rem 1rem;border-radius:8px;background:#e6eef2;color:var(--neutral-800);display:inline-flex;align-items:center;">Kembali</a>
        {{-- Optional edit link if you implement editing later --}}
        @if(isset($dokter) && ($dokter->id_user ?? null) == auth()->id())
            <a href="{{ route('dokter.profil.edit', $dokter->id_dokter) }}" class="button-primary" style="padding:0.6rem 1rem;border-radius:8px;display:inline-flex;align-items:center;">Edit Profil</a>
        @endif
    </div>
</div>
@endsection
