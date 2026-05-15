@extends('layouts.appguest')

@section('title', 'Home')

@section('content')

<style>
    /*
    |--------------------------------------------------------------------------
    | HERO PREMIUM CAFE
    |--------------------------------------------------------------------------
    */

    .hero-section {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: center;
        overflow: hidden;

        background:
            linear-gradient(
                rgba(0,0,0,0.75),
                rgba(0,0,0,0.70)
            ),
            url("{{ asset('storage/banner/ruangan.jpg') }}");

        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    /*
    |--------------------------------------------------------------------------
    | Overlay Blur
    |--------------------------------------------------------------------------
    */

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: radial-gradient(
            circle at top right,
            rgba(255,193,7,0.18),
            transparent 40%
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Text
    |--------------------------------------------------------------------------
    */

    .hero-title {
        font-size: 3.8rem;
        line-height: 1.2;
        color: #fff;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        line-height: 1.8;
    }

    /*
    |--------------------------------------------------------------------------
    | Glass Card
    |--------------------------------------------------------------------------
    */

    .glass-card {
        background: rgba(255,255,255,0.08);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 20px;
        padding: 25px;
        transition: 0.3s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    }

    .glass-card:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.12);
    }

    /*
    |--------------------------------------------------------------------------
    | Button Gradient
    |--------------------------------------------------------------------------
    */

    .btn-gradient {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
        border: none;
        font-weight: 600;
        transition: 0.3s;
        box-shadow: 0 10px 25px rgba(245,158,11,0.35);
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        color: white;
        box-shadow: 0 15px 30px rgba(245,158,11,0.45);
    }

    /*
    |--------------------------------------------------------------------------
    | Floating Image
    |--------------------------------------------------------------------------
    */

    .hero-image {
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
        animation: floatImage 4s ease-in-out infinite;
    }

    .hero-image img {
        width: 100%;
        object-fit: cover;
    }

    @keyframes floatImage {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-12px);
        }
        100% {
            transform: translateY(0px);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Responsive
    |--------------------------------------------------------------------------
    */

    @media(max-width:991px){

        .hero-section{
            padding:120px 0 80px;
            text-align:center;
        }

        .hero-title{
            font-size:2.6rem;
        }

        .hero-image{
            margin-top:40px;
        }
    }
</style>


<!-- HERO -->
<section class="hero-section">

    <div class="hero-overlay"></div>

    <div class="container position-relative">

        <div class="row align-items-center g-5">

            <!-- LEFT -->
            <div class="col-lg-6" data-aos="fade-right">

                <span class="badge bg-warning text-dark px-4 py-2 rounded-pill mb-4 shadow">
                    ✨ Sistem Kasir Premium untuk Cafe Modern
                </span>

                <h1 class="hero-title fw-bold">
                    Kelola Cafe Lebih
                    <span class="text-warning">
                        Modern,
                    </span>
                    Cepat & Profesional
                </h1>

                <p class="hero-subtitle mt-4 text-white-50">
                    CAFEPOS membantu operasional cafe menjadi lebih efisien mulai dari transaksi,
                    stok bahan baku, laporan penjualan, shift kasir,
                    hingga monitoring bisnis secara realtime.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">

                    <a href="{{ route('landing.menu') }}"
                        class="btn btn-gradient px-4 py-3 rounded-pill">
                        <i class="fa-solid fa-utensils"></i>
                        Lihat Menu
                    </a>

                    <a href="{{ route('auth.login') }}"
                        class="btn btn-outline-light px-4 py-3 rounded-pill">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        Login Sistem
                    </a>

                </div>

                <!-- QUICK INFO -->
                <div class="row mt-5 g-3">

                    <div class="col-4">
                        <div class="glass-card text-center py-3">
                            <h4 class="text-warning fw-bold mb-1">
                                <i class="fa-solid fa-bolt"></i>
                            </h4>

                            <small class="text-white-50">
                                Transaksi Cepat
                            </small>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="glass-card text-center py-3">
                            <h4 class="text-warning fw-bold mb-1">
                                <i class="fa-solid fa-chart-line"></i>
                            </h4>

                            <small class="text-white-50">
                                Real Time
                            </small>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="glass-card text-center py-3">
                            <h4 class="text-warning fw-bold mb-1">
                                <i class="fa-solid fa-shield-halved"></i>
                            </h4>

                            <small class="text-white-50">
                                Aman
                            </small>
                        </div>
                    </div>

                </div>

            </div>

          

        </div>

    </div>

</section>

@endsection