@extends('layouts.appguest')

@section('title', 'Home')

@section('content')

<!-- HERO -->
<section class="hero-section" style="margin-top:90px;">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3">
                    Sistem Kasir Modern untuk Cafe & Restoran
                </span>

                <h1 class="hero-title fw-bold">
                    Kelola Bisnis Cafe Lebih Cepat dengan
                    <span class="text-warning">CAFEPOS</span>
                </h1>

                <p class="hero-subtitle mt-3 text-white-50">
                    CAFEPOS adalah aplikasi kasir profesional untuk membantu transaksi, stok bahan baku,
                    laporan penjualan, promo, pajak, hingga shift kasir berjalan otomatis dan rapi.
                </p>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('landing.menu') }}" class="btn btn-gradient px-4 py-2 rounded-pill">
                        <i class="fa-solid fa-utensils"></i> Lihat Menu
                    </a>

                    <a href="{{ route('auth.login') }}" class="btn btn-outline-light px-4 py-2 rounded-pill">
                        <i class="fa-solid fa-right-to-bracket"></i> Login Sistem
                    </a>

                    <a href="{{ route('landing.kontak') }}" class="btn btn-outline-warning px-4 py-2 rounded-pill">
                        <i class="fa-solid fa-headset"></i> Hubungi Kami
                    </a>
                </div>

                <!-- QUICK STATS -->
                <div class="row mt-5 g-3">

                    <div class="col-4">
                        <div class="glass-card text-center py-3">
                            <h4 class="fw-bold text-warning mb-0">
                                <i class="fa-solid fa-bolt"></i>
                            </h4>
                            <small class="text-white-50">Transaksi Cepat</small>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="glass-card text-center py-3">
                            <h4 class="fw-bold text-warning mb-0">
                                <i class="fa-solid fa-shield-halved"></i>
                            </h4>
                            <small class="text-white-50">Aman Multi Role</small>
                        </div>
                    </div>

                    <div class="col-4">
                        <div class="glass-card text-center py-3">
                            <h4 class="fw-bold text-warning mb-0">
                                <i class="fa-solid fa-chart-line"></i>
                            </h4>
                            <small class="text-white-50">Laporan Otomatis</small>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-6 text-center" data-aos="fade-left">
                <img src="{{ asset('storage/banner/cafe.jpeg') }}"
                    class="img-fluid rounded-4 shadow-lg"
                    alt="CAFEPOS">
            </div>

        </div>
    </div>
</section>


<!-- FEATURES -->
<section class="py-5">
    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title fw-bold">Fitur Utama CAFEPOS</h2>
            <p class="text-white-50">
                Semua kebutuhan cafe dan restoran tersedia dalam satu sistem.
            </p>
        </div>

        <div class="row g-4">

            <div class="col-md-4" data-aos="zoom-in">
                <div class="glass-card text-center h-100">
                    <i class="fa-solid fa-cash-register fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">POS & Pembayaran</h5>
                    <p class="text-white-50">
                        Sistem kasir cepat, transaksi realtime, pembayaran cash/noncash,
                        dan otomatis menghitung kembalian.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="glass-card text-center h-100">
                    <i class="fa-solid fa-boxes-stacked fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">Inventory & Supplier</h5>
                    <p class="text-white-50">
                        Kelola bahan baku, stok masuk/keluar, pembelian supplier,
                        dan monitoring stok minimal.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="glass-card text-center h-100">
                    <i class="fa-solid fa-chart-pie fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">Laporan Lengkap</h5>
                    <p class="text-white-50">
                        Laporan harian, bulanan, produk terlaris, shift kasir,
                        hingga laporan keuntungan otomatis.
                    </p>
                </div>
            </div>

        </div>

        <div class="row g-4 mt-2">

            <div class="col-md-4" data-aos="zoom-in">
                <div class="glass-card text-center h-100">
                    <i class="fa-solid fa-users fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">Multi Role</h5>
                    <p class="text-white-50">
                        Owner, Manager, dan Kasir memiliki akses menu berbeda
                        sesuai hak akses masing-masing.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="glass-card text-center h-100">
                    <i class="fa-solid fa-receipt fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">Cetak Struk</h5>
                    <p class="text-white-50">
                        Struk otomatis dibuat setelah transaksi sukses
                        dan bisa dicetak kapan saja.
                    </p>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="glass-card text-center h-100">
                    <i class="fa-solid fa-percent fs-1 text-warning"></i>
                    <h5 class="fw-bold mt-3">Promo & Pajak</h5>
                    <p class="text-white-50">
                        Kelola promo diskon persen/fixed, pajak restoran,
                        dan total transaksi otomatis dihitung sistem.
                    </p>
                </div>
            </div>

        </div>

    </div>
</section>


<!-- ABOUT -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-6" data-aos="fade-right">
                <img src="{{ asset('storage/banner/hanla.jpeg') }}"
                    class="img-fluid rounded-4 shadow-lg"
                    alt="CAFEPOS Preview">
            </div>

            <div class="col-lg-6" data-aos="fade-left">
                <h2 class="section-title fw-bold">Kenapa Harus CAFEPOS?</h2>

                <p class="text-white-50 mt-3">
                    CAFEPOS dibuat khusus untuk cafe/restoran agar pengelolaan bisnis lebih cepat,
                    laporan lebih akurat, dan operasional lebih terkontrol.
                </p>

                <ul class="text-white-50 mt-4">
                    <li class="mb-2">
                        <i class="fa-solid fa-check text-warning"></i>
                        Sistem transaksi cepat dan user friendly
                    </li>
                    <li class="mb-2">
                        <i class="fa-solid fa-check text-warning"></i>
                        Shift kasir terkontrol dengan saldo awal/akhir
                    </li>
                    <li class="mb-2">
                        <i class="fa-solid fa-check text-warning"></i>
                        Laporan otomatis tanpa hitung manual
                    </li>
                    <li class="mb-2">
                        <i class="fa-solid fa-check text-warning"></i>
                        Inventory rapi untuk menghindari stok habis
                    </li>
                </ul>

                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('landing.menu') }}" class="btn btn-gradient px-4 py-2 rounded-pill">
                        <i class="fa-solid fa-utensils"></i> Lihat Menu
                    </a>

                    <a href="{{ route('landing.promo') }}" class="btn btn-outline-warning px-4 py-2 rounded-pill">
                        <i class="fa-solid fa-tags"></i> Lihat Promo
                    </a>
                </div>

            </div>

        </div>
    </div>
</section>


<!-- CTA -->
<section class="py-5">
    <div class="container">
        <div class="glass-card text-center p-5" data-aos="fade-up">
            <h2 class="fw-bold">Siap Mengelola Cafe Lebih Profesional?</h2>
            <p class="text-white-50 mt-3 mb-4">
                Gunakan CAFEPOS sekarang dan rasakan sistem kasir modern yang cepat, rapi, dan mudah digunakan.
            </p>

            <div class="d-flex justify-content-center flex-wrap gap-3">
                <a href="{{ route('auth.login') }}" class="btn btn-gradient px-5 py-2 rounded-pill">
                    <i class="fa-solid fa-right-to-bracket"></i> Login Sekarang
                </a>

                <a href="{{ route('landing.kontak') }}" class="btn btn-outline-light px-5 py-2 rounded-pill">
                    <i class="fa-solid fa-envelope"></i> Kontak Admin
                </a>
            </div>
        </div>
    </div>
</section>

@endsection