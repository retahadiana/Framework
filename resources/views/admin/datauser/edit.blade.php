@extends('layouts.admin')
@section('content')
<div class="edit-card">
    <h2>Edit User</h2>
    <form action="{{ route('user.update', $user->iduser) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama" class="@error('nama') is-invalid @enderror" value="{{ old('nama', $user->nama) }}">
        @error('nama')
            <div class="invalid-feedback" style="color:#e74c3c; font-size:0.95rem; margin-bottom:10px;">{{ $message }}</div>
        @enderror
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="@error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}">
        @error('email')
            <div class="invalid-feedback" style="color:#e74c3c; font-size:0.95rem; margin-bottom:10px;">{{ $message }}</div>
        @enderror
        <div class="btn-row">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
