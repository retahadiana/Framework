@extends('Layouts.app')

@section('content')
    <div class="page-section">
        <h2>Manajemen Data User</h2>
        <a href="{{ route('user.create') }}" class="btn btn-success mb-3">+ Tambah User</a>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID User</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->iduser }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('user.edit', $item->iduser) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ route('user.showResetPassword', $item->iduser) }}" class="btn btn-warning btn-sm">Reset Password</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection