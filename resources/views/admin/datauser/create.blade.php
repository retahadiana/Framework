@extends('layouts.admin')
@section('content')
<div class="form-card">
    <h2>Tambah User</h2>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <label for="nama">Nama</label>
    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>
        <div class="btn-row">
            <button type="submit" class="btn btn-success">Tambah</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
