@extends('Layouts.lte.main')
@section('page-title','Detail Jenis Hewan')
@section('content')
<div class="container-fluid">
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Detail Jenis Hewan</h3>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Nama Jenis Hewan</dt>
                <dd class="col-sm-9">{{ $jenisHewan->nama_jenis_hewan }}</dd>
            </dl>
        </div>
        <div class="card-footer">
            <a href="{{ route('jenis_hewan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
