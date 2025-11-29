@extends('Layouts.lte.main')

@section('title','Daftar Pemilik')
@section('page-title','Pemilik')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-rshp">Daftarkan Pemilik Baru</a>
        </div>

        <div class="col-12">
            <div class="card card-modern">
                <div class="card-header">Daftar Pemilik</div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. WhatsApp</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td>{{ $item->idpemilik }}</td>
                                    <td>{{ optional($item->user)->nama ?? '-' }}</td>
                                    <td>{{ optional($item->user)->email ?? '-' }}</td>
                                    <td>{{ $item->no_wa ?? '-' }}</td>
                                    <td>{{ $item->alamat ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('resepsionis.pemilik.edit', $item->idpemilik) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('resepsionis.pemilik.destroy', $item->idpemilik) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Belum ada data pemilik.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
