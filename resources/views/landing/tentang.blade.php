@extends('layouts.appguest')

@section('title', 'Tentang')

@section('content')
<section class="py-5" style="margin-top:90px;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Tentang CAFEPOS</h2>
            <p class="text-white-50">
                Sistem kasir cafe modern untuk membantu bisnis berkembang lebih cepat.
            </p>
        </div>

        <div class="row g-4 align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="glass-card">
                    <h4 class="fw-bold text-warning">Apa itu CAFEPOS?</h4>
                    <p class="text-white-50 mt-3">
                        CAFEPOS adalah aplikasi Point Of Sale (POS) yang dirancang khusus untuk cafe dan restoran.
                        Dengan fitur lengkap seperti transaksi kasir, stok bahan baku, shift kasir, laporan harian/bulanan,
                        serta pengelolaan promo dan pajak.
                    </p>

                    <h5 class="fw-bold mt-4">Tujuan CAFEPOS</h5>
                    <ul class="text-white-50">
                        <li>Meningkatkan kecepatan transaksi</li>
                        <li>Membantu kontrol stok bahan baku</li>
                        <li>Menghasilkan laporan otomatis</li>
                        <li>Meningkatkan efisiensi kerja kasir</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 text-center" data-aos="fade-left">
                <img src="{{ asset('storage/banner/ruangan.jpg') }}" class="img-fluid rounded-4 shadow-lg" alt="Tentang CAFEPOS">
            </div>
        </div>

        <div class="row mt-5 g-4">
            <div class="col-md-4" data-aos="zoom-in">
                <div class="glass-card text-center">
                    <i class="fa-solid fa-users fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">Multi Role</h5>
                    <p class="text-white-50">
                        Owner, Manager, dan Kasir memiliki akses berbeda sesuai kebutuhan.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="glass-card text-center">
                    <i class="fa-solid fa-shield-halved fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">Aman</h5>
                    <p class="text-white-50">
                        Sistem keamanan role dan login history untuk memonitor aktivitas.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="glass-card text-center">
                    <i class="fa-solid fa-bolt fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">Cepat</h5>
                    <p class="text-white-50">
                        UI modern dengan performa cepat untuk transaksi kasir.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection