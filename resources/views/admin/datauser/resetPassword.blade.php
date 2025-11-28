@extends('layouts.lte.main')
@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="mb-4">Reset Password User</h2>

        <form action="{{ route('user.resetPassword', $user->iduser) }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="old_password">Password Lama</label>
                    <input type="password" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror">
                    @error('old_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="password">Password Baru</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-warning">Reset Password</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary ml-2">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection 
