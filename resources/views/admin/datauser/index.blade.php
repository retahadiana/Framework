@extends('Layouts.app')

@section('content')
<div class="page-section">
    <h2><i class="fas fa-user-cog"></i> Daftar User</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Roles</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $item->iduser }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        @foreach ($item->role as $role)
                            {{ $role->nama_role }} ({{ $role->pivot->status }})
                            @if (!$loop->last), @endif
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
