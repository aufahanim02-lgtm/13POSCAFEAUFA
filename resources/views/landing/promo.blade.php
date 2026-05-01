@extends('layouts.appguest')

@section('title', 'Promo')

@section('content')
<section class="py-5" style="margin-top:90px;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Promo Spesial</h2>
            <p class="text-white-50">
                Nikmati promo menarik setiap hari untuk menu favorit kamu.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4" data-aos="zoom-in">
                <div class="glass-card">
                    <h4 class="fw-bold text-warning">
                        <i class="fa-solid fa-tags"></i> Diskon 20%
                    </h4>
                    <p class="text-white-50">
                        Berlaku untuk semua menu kopi setiap hari Senin - Jumat.
                    </p>
                    <p class="fw-bold mb-0">Periode:</p>
                    <p class="text-white-50">01 Mei - 31 Mei</p>
                    <a href="{{ url('/menu') }}" class="btn btn-gradient rounded-pill w-100">
                        Lihat Menu
                    </a>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="glass-card">
                    <h4 class="fw-bold text-warning">
                        <i class="fa-solid fa-gift"></i> Buy 1 Get 1
                    </h4>
                    <p class="text-white-50">
                        Beli 1 Es Teh Lemon gratis 1 Es Teh Original.
                    </p>
                    <p class="fw-bold mb-0">Periode:</p>
                    <p class="text-white-50">Setiap Weekend</p>
                    <a href="{{ url('/menu') }}" class="btn btn-gradient rounded-pill w-100">
                        Ambil Promo
                    </a>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="glass-card">
                    <h4 class="fw-bold text-warning">
                        <i class="fa-solid fa-fire"></i> Paket Hemat
                    </h4>
                    <p class="text-white-50">
                        Paket nasi goreng + es teh hanya Rp 30.000.
                    </p>
                    <p class="fw-bold mb-0">Periode:</p>
                    <p class="text-white-50">01 Juni - 30 Juni</p>
                    <a href="{{ url('/menu') }}" class="btn btn-gradient rounded-pill w-100">
                        Lihat Paket
                    </a>
                </div>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <h5 class="fw-bold">Jangan Lewatkan Promo Terbaru!</h5>
            <p class="text-white-50">
                Promo dapat berubah sewaktu-waktu sesuai kebijakan cafe.
            </p>
        </div>
    </div>
</section>
@endsection