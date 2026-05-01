@extends('layouts.appguest')

@section('title', 'Home')

@section('content')
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="hero-title">
                    Aplikasi Kasir Cafe Modern <span class="text-warning">CAFEPOS</span>
                </h1>

                <p class="hero-subtitle mt-3">
                    Kelola transaksi, stok bahan baku, laporan penjualan, dan shift kasir
                    dengan cepat dan profesional.
                </p>

                <div class="d-flex gap-3 mt-4">
                    <a href="{{ url('/menu') }}" class="btn btn-gradient px-4 py-2 rounded-pill">
                        <i class="fa-solid fa-utensils"></i> Lihat Menu
                    </a>

                    <a href="{{ url('/login') }}" class="btn btn-outline-light px-4 py-2 rounded-pill">
                        <i class="fa-solid fa-user"></i> Login Kasir
                    </a>
                </div>

                <div class="mt-5 d-flex gap-4">
                    <div>
                        <h4 class="fw-bold text-warning">Fast</h4>
                        <p class="text-white-50 mb-0">Transaksi cepat</p>
                    </div>

                    <div>
                        <h4 class="fw-bold text-warning">Secure</h4>
                        <p class="text-white-50 mb-0">Akses role aman</p>
                    </div>

                    <div>
                        <h4 class="fw-bold text-warning">Report</h4>
                        <p class="text-white-50 mb-0">Laporan otomatis</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 text-center" data-aos="fade-left">
                <img src="{{ asset('foto/banner/hero.png') }}" class="img-fluid rounded-4 shadow-lg" alt="CAFEPOS Hero">
            </div>

        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Fitur Unggulan CAFEPOS</h2>
            <p class="text-white-50">
                Sistem kasir yang dibuat khusus untuk cafe dan restoran modern.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in">
                <div class="glass-card text-center">
                    <i class="fa-solid fa-cash-register fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">POS Cepat</h5>
                    <p class="text-white-50">
                        Sistem transaksi kasir cepat dengan tampilan modern dan mudah digunakan.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="glass-card text-center">
                    <i class="fa-solid fa-boxes-stacked fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">Inventory Stok</h5>
                    <p class="text-white-50">
                        Kelola stok bahan baku masuk/keluar dan pembelian supplier dengan rapi.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="400">
                <div class="glass-card text-center">
                    <i class="fa-solid fa-chart-line fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">Laporan Otomatis</h5>
                    <p class="text-white-50">
                        Laporan harian, bulanan, keuntungan, laporan kasir, dan laporan shift otomatis.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            
            <div class="col-lg-6" data-aos="fade-right">
                <img src="{{ asset('foto/banner/mockup.png') }}" class="img-fluid rounded-4 shadow-lg" alt="CAFEPOS Mockup">
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="section-title">Cocok Untuk Cafe & Restoran</h2>
                <p class="text-white-50 mt-3">
                    CAFEPOS dirancang untuk membantu bisnis kamu berkembang dengan sistem kasir yang stabil,
                    modern, dan terintegrasi.
                </p>

                <ul class="text-white-50 mt-4">
                    <li class="mb-2"><i class="fa-solid fa-check text-warning"></i> Multi Role (Owner, Manager, Kasir)</li>
                    <li class="mb-2"><i class="fa-solid fa-check text-warning"></i> Sistem Shift Kasir</li>
                    <li class="mb-2"><i class="fa-solid fa-check text-warning"></i> Support Barcode Produk</li>
                    <li class="mb-2"><i class="fa-solid fa-check text-warning"></i> Cetak Struk Otomatis</li>
                </ul>

                <a href="{{ url('/kontak') }}" class="btn btn-gradient px-4 py-2 rounded-pill mt-4">
                    <i class="fa-solid fa-headset"></i> Hubungi Kami
                </a>
            </div>

        </div>
    </div>
</section>
@endsection