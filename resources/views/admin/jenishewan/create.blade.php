@extends('layouts.admin')
@section('content')
<style>
    .jenis-create-card {
        max-width: 420px;
        margin: 60px auto;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        padding: 40px 32px 32px 32px;
        text-align: center;
    }
    .jenis-create-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a3365;
        margin-bottom: 32px;
    }
    .jenis-create-label {
        font-weight: 500;
        font-size: 1.1rem;
        color: #1a3365;
        margin-bottom: 10px;
        text-align: left;
        display: block;
    }
    .jenis-create-input {
        width: 100%;
        padding: 16px;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        margin-bottom: 28px;
        font-size: 1.1rem;
        background: #f9fafb;
    }
    .jenis-create-btn-row {
        display: flex;
        gap: 18px;
        justify-content: center;
        margin-top: 10px;
    }
    .jenis-create-btn-simpan {
        background: #27ae60;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 18px 0;
        font-size: 1.2rem;
        font-weight: 700;
        width: 48%;
        box-shadow: 0 1px 4px rgba(39,174,96,0.08);
        transition: background 0.2s;
    }
    .jenis-create-btn-simpan:hover {
        background: #219150;
    }
    .jenis-create-btn-batal {
        background: #7b8a8b;
        color: #fff;
        border: none;
        border-radius: 10px;
        padding: 18px 0;
        font-size: 1.2rem;
        font-weight: 700;
        width: 48%;
        box-shadow: 0 1px 4px rgba(123,138,139,0.08);
        transition: background 0.2s;
        text-decoration: none;
        display: inline-block;
    }
    .jenis-create-btn-batal:hover {
        background: #566363;
    }
</style>
<div style="background: #f6fbfd; min-height: 100vh; padding-top: 40px;">
    <div class="jenis-create-card">
        <div class="jenis-create-title">Tambah Jenis Hewan</div>
        <form action="{{ route('jenis-hewan.store') }}" method="POST">
            @csrf
            <label for="nama_jenis_hewan" class="jenis-create-label">Nama Jenis</label>
            <input type="text" name="nama_jenis_hewan" class="jenis-create-input @error('nama_jenis_hewan') is-invalid @enderror" value="{{ old('nama_jenis_hewan') }}">
            @error('nama_jenis_hewan')
                <div class="invalid-feedback" style="color:#e74c3c;text-align:left;margin-bottom:10px;">{{ $message }}</div>
            @enderror
            <div class="jenis-create-btn-row">
                <button type="submit" class="jenis-create-btn-simpan">Simpan</button>
                <a href="{{ route('jenis-hewan.index') }}" class="jenis-create-btn-batal">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
