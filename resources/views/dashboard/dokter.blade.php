@extends('Layouts.lte.Dokter.main')

@section('content')


<div class="container page-section">
    <div class="row align-items-center mb-5">
        <div class="col-md-7">
            <h1 style="color:#38a3b7;font-weight:800;letter-spacing:-1px;margin-bottom:0.5rem;display:flex;align-items:center;gap:0.7rem">
                <i class="fas fa-user-md" style="font-size:2.5rem;"></i> Dashboard Dokter
            </h1>
            <div style="height:3px;width:100px;background:linear-gradient(90deg,#38a3b7,#0891b2,#3b82f6);border-radius:2px;margin-bottom:1.5rem;"></div>
            <p class="text-muted mb-3" style="font-size:1.15rem">Selamat datang, <span class="fw-semibold" style="color:#0891b2">{{ Auth::user()->nama ?? 'Dokter' }}</span>!<br>Terima kasih telah menjadi bagian penting dalam menjaga kesehatan hewan di RSHP.</p>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius:18px;background:linear-gradient(120deg,#e0f7fa 60%,#f0f9ff 100%);">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="me-4" style="font-size:2.7rem;color:#38a3b7"><i class="fas fa-heartbeat"></i></div>
                    <div>
                        <div class="fw-bold mb-1" style="font-size:1.25rem;color:#0891b2">Tips Kesehatan Hewan</div>
                        <div class="text-muted" style="font-size:1.05rem">Pastikan hewan peliharaan Anda mendapatkan vaksinasi rutin dan pemeriksaan kesehatan secara berkala untuk mencegah penyakit.</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100" style="border-radius:18px;background:linear-gradient(120deg,#f0f9ff 60%,#e0f7fa 100%);">
                <div class="card-body d-flex align-items-center p-4">
                    <div class="me-4" style="font-size:2.7rem;color:#3b82f6"><i class="fas fa-paw"></i></div>
                    <div>
                        <div class="fw-bold mb-1" style="font-size:1.25rem;color:#0891b2">Motivasi untuk Dokter</div>
                        <div class="text-muted" style="font-size:1.05rem">Setiap hewan yang Anda rawat adalah bukti dedikasi dan kepedulian Anda. Teruslah berkontribusi untuk dunia yang lebih sehat!</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-12 text-center">
            <div style="display:inline-block;padding:2.2rem 2.5rem;background:linear-gradient(120deg,#38a3b7 60%,#3b82f6 100%);border-radius:22px;box-shadow:0 4px 24px 0 #0891b233;">
                <div style="font-size:2.5rem;color:#fff;"><i class="fas fa-dog"></i> <i class="fas fa-cat"></i></div>
                <div class="fw-bold mt-2" style="font-size:1.3rem;color:#fff;">Jaga kesehatan, kebahagiaan, dan kesejahteraan hewan bersama RSHP!</div>
            </div>
        </div>
    </div>
</div>

@endsection
