@extends('layouts.app')

@section('title', 'Home - RSHP UNAIR')

@section('content')
    <!--HALAMAN HOME -->
    <section id="beranda" class="content-container">
        <div class="left-column">
            <!-- Added icons to buttons -->
            <a href="#" class="button-primary">
                <i class="fas fa-calendar-plus"></i>
                PENDAFTARAN ONLINE
            </a>
            <p class="text-block">
                Rumah Sakit Hewan Pendidikan Universitas Airlangga berinovasi
                untuk selalu meningkatkan kualitas pelayanan, maka dari itu
                Rumah Sakit Hewan Pendidikan Universitas Airlangga mempunyai
                fitur pendaftaran online yang mempermudah untuk mendaftarkan
                hewan kesayangan anda.
            </p>
            <a href="#" class="button-secondary">
                <i class="fas fa-clock"></i>
                INFORMASI JADWAL DOKTER JAGA
            </a>
        </div>
<!-- # membuat elemen <a> bisa diklik , class="button-secondary" untuk memberi gaya visual pada tautan <a> agar terlihat seperti tombol., class="fas fa-clock" untuk memberi icon pada tombol <a> -->
        <div class="right-column">
            <div class="video-container">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/rCfvZPECZvE" title="Video RSHP UNAIR" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </section>
@endsection