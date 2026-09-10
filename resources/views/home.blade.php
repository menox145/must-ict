@extends('layouts.main')

@section('container')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="text-center mb-4">Selamat Datang di Dashboard ICT RSPJ</h2>
        
        <div id="ictCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#ictCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#ictCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#ictCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner rounded shadow">
                <!-- Slide 1: Tentang ICT -->
                <div class="carousel-item active bg-primary text-white" style="height: 400px;">
                    <div class="d-flex flex-column justify-content-center align-items-center h-100 p-5 text-center">
                        <i class="bi bi-pc-display display-1 mb-3"></i>
                        <h1>Tentang ICT</h1>
                        <p class="lead">Information and Communication Technology (ICT) RSPJ bertugas mengelola, memelihara, dan mengembangkan infrastruktur teknologi dan sistem informasi rumah sakit.</p>
                    </div>
                </div>
                
                <!-- Slide 2: Solusi Troubleshooting -->
                <div class="carousel-item bg-success text-white" style="height: 400px;">
                    <div class="d-flex flex-column justify-content-center align-items-center h-100 p-5 text-center">
                        <i class="bi bi-tools display-1 mb-3"></i>
                        <h1>Solusi Troubleshooting</h1>
                        <p class="lead">Kami menyediakan panduan dan bantuan teknis untuk menyelesaikan berbagai kendala perangkat keras, perangkat lunak, maupun jaringan secara cepat dan efisien.</p>
                    </div>
                </div>
                
                <!-- Slide 3: Company Profile -->
                <div class="carousel-item bg-info text-dark" style="height: 400px;">
                    <div class="d-flex flex-column justify-content-center align-items-center h-100 p-5 text-center">
                        <i class="bi bi-building display-1 mb-3"></i>
                        <h1>Company Profile</h1>
                        <p class="lead">Menjadi pusat inovasi teknologi informasi di lingkungan rumah sakit, mendukung pelayanan kesehatan yang prima dan terintegrasi melalui digitalisasi.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#ictCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#ictCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</div>

<div class="text-center mt-5">
    <p>Silakan masuk ke dalam sistem untuk mengakses fitur manajemen dan peminjaman.</p>
    <a href="/login" class="btn btn-outline-primary btn-lg mx-2"><i class="bi bi-door-open"></i> Login ke Sistem</a>
    <a href="/pinjam/public" class="btn btn-outline-success btn-lg mx-2"><i class="bi bi-box-arrow-in-right"></i> Peminjaman Barang Umum</a>
</div>
@endsection
