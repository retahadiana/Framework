@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="fw-bold text-secondary">Dashboard Pemilik</h1>
        <p class="text-muted">Selamat datang, pantau status hewan peliharaan Anda di sini.</p>

        <div class="card mt-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-secondary">🐶 Data Hewan Anda</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Warna Tanda</th>
                            <th>Jenis Kelamin</th>
                            <th>Pemilik</th>
                            <th>Ras Hewan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($daty as $item)
                            <tr>
                                <td>{{ $item->idpet }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->tanggal_lahir }}</td>
                                <td>{{ $item->warna_tanda }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ data_get($item, 'pemilik.user.nama') ?? data_get($item, 'pemilik.user.name') ?? 'N/A' }}
                                </td>
                                <td>{{ $item->rasHewan->nama_ras ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection