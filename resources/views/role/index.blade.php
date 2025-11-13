@extends('Layouts.lte.main')

@section('content')
<h3>Daftar Role</h3>
<table class="table table-bordered">
    <thead>
        <tr><th>ID</th><th>Nama Role</th></tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
        <tr>
            <td>{{ $item->idrole }}</td>
            <td>{{ $item->nama_role }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
