@extends('Layouts.app')

@section('content')
<h3>Daftar User</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Nama</th><th>Email</th><th>Roles</th></tr>
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
@endsection
