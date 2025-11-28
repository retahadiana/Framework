@extends('layouts.lte.main')

@section('content')

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card">
                <div class="card-body">
                    <h3 class="mb-3">Tambah Role untuk User ID {{ $user->iduser }}</h3>

                    <form action="{{ route('role.store', $user->iduser) }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="idrole">Pilih Role</label>
                            <select name="idrole" id="idrole" class="form-control @error('idrole') is-invalid @enderror">
                                <option value="">-- Pilih Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->idrole }}" {{ old('idrole') == $role->idrole ? 'selected' : '' }}>{{ $role->nama_role }}</option>
                                @endforeach
                            </select>
                            @error('idrole')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3 form-check">
                            <input type="checkbox" name="status" id="status" value="1" class="form-check-input" {{ old('status') ? 'checked' : '' }}>
                            <label class="form-check-label" for="status">Aktif</label>
                            @error('status')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary">Tambah Role</button>
                            <a href="{{ route('role.index') }}" class="btn btn-secondary ml-2">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
