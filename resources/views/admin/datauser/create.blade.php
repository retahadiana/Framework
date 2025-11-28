@extends('layouts.lte.main')
@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="mb-4">Tambah User</h2>

        <form action="{{ route('user.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-success">Tambah</button>
                <a href="{{ route('user.index') }}" class="btn btn-secondary ml-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
