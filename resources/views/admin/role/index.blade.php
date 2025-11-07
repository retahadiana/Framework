@extends('Layouts.app')

@section('content')
<div class="page-section">
    <h2><i class="fas fa-user-shield"></i> Daftar Role User</h2>
    <div class="user-table-container">
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID User</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $user)
                <tr>
                    <td>{{ $user->iduser }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>
                        @if($user->roles && $user->roles->count())
                            @foreach($user->roles as $role)
                                {{ $role->nama_role }}
                                ({{ $role->pivot->status == 1 ? 'Aktif' : 'Non-Aktif' }})<br>
                            @endforeach
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('role.create', ['iduser' => $user->iduser]) }}" class="btn btn-success mb-3">+ Tambah Role</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
