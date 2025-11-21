@extends('Layouts.lte.resepsionis.main')

@section('title','Daftar Pet')
@section('page-title','Pet')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-12 mb-3">
            <a href="{{ route('resepsionis.pet.create') }}" class="btn btn-rshp">Daftarkan Pet Baru</a>
        </div>

        <div class="col-12">
            <div class="card card-modern">
                <div class="card-header">Daftar Pet</div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Ras</th>
                                <th>Pemilik</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td>{{ $item->idpet }}</td>
                                    <td>{{ $item->nama ?? '-' }}</td>
                                    <td>{{ optional($item->tanggal_lahir)->format('d/m/Y') ?? '-' }}</td>
                                    <td>{{ optional($item->rasHewan)->nama_ras ?? '-' }}</td>
                                    <td>{{ optional(optional($item->pemilik)->user)->nama ?? (optional($item->pemilik)->nama_pemilik ?? '-') }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="text-center">Belum ada data pet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
