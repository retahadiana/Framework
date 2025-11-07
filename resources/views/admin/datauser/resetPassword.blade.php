@extends('layouts.admin')
@section('content')

<div class="reset-card">
    <h2>Reset Password User</h2>
    <form action="{{ route('user.resetPassword', $user->iduser) }}" method="POST">
        @csrf
        <label for="old_password">Password Lama</label>
        <input type="password" name="old_password" id="old_password" class="@error('old_password') is-invalid @enderror">
        @error('old_password')
            <div class="invalid-feedback" style="color:#e74c3c; font-size:0.95rem; margin-bottom:10px;">{{ $message }}</div>
        @enderror
        <label for="password">Password Baru</label>
        <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror">
        @error('password')
            <div class="invalid-feedback" style="color:#e74c3c; font-size:0.95rem; margin-bottom:10px;">{{ $message }}</div>
        @enderror
        <div class="btn-row">
            <button type="submit" class="btn btn-warning">Reset Password</button>
            <a href="{{ route('user.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
