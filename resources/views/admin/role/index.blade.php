@extends('Layouts.app')

@section('content')
<div class="page-section">
    <h2><i class="fas fa-user-shield"></i> Daftar Role</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Role</th>
                </tr>
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
    </div>
</div>
@endsection
