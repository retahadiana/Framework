@extends('Layouts.lte.main')

@section('content')
@include('partials.table-standard')
@include('partials.action-buttons')

<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
            <div>
                <h3 class="card-title mb-0"><i class="fas fa-user-shield me-2"></i> Daftar Role User</h3>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="thead-light">
                        <tr>
                            <th>ID User</th>
                            <th>Nama</th>
                            <th>Role</th>
                            <th style="width:160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $user)
                        <tr>
                            <td>{{ $user->iduser }}</td>
                            <td>{{ $user->nama }}</td>
                            <td>
                                @if($user->nama_role)
                                    {{ $user->nama_role }} ({{ $user->role_status == 1 ? 'Aktif' : 'Non-Aktif' }})
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('role.create', ['iduser' => $user->iduser]) }}" class="btn btn-sm btn-success">Tambah Role</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
