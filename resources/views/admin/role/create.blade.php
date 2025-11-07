@extends('layouts.admin')
@section('content')
<div class="role-card">
    <h2>Tambah Role untuk User ID {{ $user->iduser }}</h2>
    <form action="{{ route('role.store', $user->iduser) }}" method="POST">
        @csrf
        <label for="idrole">Pilih Role</label>
        <select name="idrole" id="idrole">
            <option value="">-- Pilih Role --</option>
            @foreach($roles as $role)
                <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
            @endforeach
        </select>
        <label for="status">Status</label>
        <div class="form-check">
            <input type="checkbox" name="status" id="status" value="1">
            <label for="status">Aktif</label>
        </div>
        <div class="btn-row">
            <button type="submit" class="btn btn-primary">Tambah Role</button>
            <a href="{{ route('role.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
