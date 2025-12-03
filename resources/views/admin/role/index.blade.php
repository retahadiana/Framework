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
                            <th style="width:260px;">Aksi</th>
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
                                <div class="d-flex justify-content-end align-items-center" style="gap:8px;">
                                    <a href="{{ route('role.create', ['iduser' => $user->iduser]) }}" class="btn btn-sm btn-success">Tambah Role</a>
                                    @if(!empty($user->idrole_user))
                                        <form action="{{ route('role.destroy', $user->idrole_user) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus role ini untuk user tersebut?');" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    @endif
                                </div>
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
