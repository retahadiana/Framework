@extends('Layouts.lte.main')

@section('content')
@include('partials.table-standard')
@include('partials.action-buttons')

<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Manajemen Data Pemilik</h3>
        <a href="{{ route('pemilik.create') }}" class="btn btn-success">+ Tambah Pemilik</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>ID Pemilik</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. WhatsApp</th>
                        <th>Alamat</th>
                        <th style="width:180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $item->idpemilik }}</td>
                        <td>{{ $item->nama_user ?? '-' }}</td>
                        <td>{{ $item->email_user ?? '-' }}</td>
                        <td>{{ $item->no_wa }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>
                            <a href="{{ route('pemilik.edit', $item->idpemilik) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ route('pemilik.destroy', $item->idpemilik) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus pemilik ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
