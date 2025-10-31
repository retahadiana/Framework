@extends('Layouts.app')

@section('content')
<div class="page-section">
    <h2><i class="fas fa-file-medical"></i> Daftar Rekam Medis</h2>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Pet</th>
                    <th>Dokter</th>
                    <th>Diagnosa</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <!-- Placeholder for rekam medis data -->
                <tr>
                    <td colspan="6" class="text-center text-muted">Data rekam medis akan ditampilkan di sini</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
