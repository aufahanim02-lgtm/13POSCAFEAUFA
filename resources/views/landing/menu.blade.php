@extends('layouts.appguest')

@section('title', 'Menu')

@section('content')
<section class="py-5" style="margin-top:90px;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Menu CAFEPOS</h2>
            <p class="text-white-50">
                Pilihan menu terbaik dengan harga terjangkau dan rasa berkualitas.
            </p>
        </div>

        <!-- Search Menu -->
        <div class="row justify-content-center mb-4" data-aos="fade-up">
            <div class="col-md-8">
                <div class="glass-card">
                    <form action="#" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control bg-dark text-white border-0"
                                   placeholder="Cari menu... (contoh: kopi, nasi goreng, teh)">
                            <button class="btn btn-gradient px-4" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i> Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Menu List -->
        <div class="row g-4">
            <!-- Card Menu -->
            <div class="col-md-4" data-aos="zoom-in">
                <div class="glass-card">
                    <img src="{{ asset('foto/produk/produk1.jpg') }}" class="img-fluid rounded-4 mb-3" alt="Menu">
                    <h5 class="fw-bold">Kopi Susu Gula Aren</h5>
                    <p class="text-white-50 mb-2">
                        Kopi robusta premium dengan susu segar dan gula aren asli.
                    </p>
                    <h6 class="text-warning fw-bold">Rp 18.000</h6>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="glass-card">
                    <img src="{{ asset('foto/produk/produk2.jpg') }}" class="img-fluid rounded-4 mb-3" alt="Menu">
                    <h5 class="fw-bold">Nasi Goreng Spesial</h5>
                    <p class="text-white-50 mb-2">
                        Nasi goreng dengan telur, ayam suwir, dan kerupuk renyah.
                    </p>
                    <h6 class="text-warning fw-bold">Rp 25.000</h6>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="glass-card">
                    <img src="{{ asset('foto/produk/produk3.jpg') }}" class="img-fluid rounded-4 mb-3" alt="Menu">
                    <h5 class="fw-bold">Es Teh Lemon</h5>
                    <p class="text-white-50 mb-2">
                        Teh segar dengan lemon asli, cocok untuk cuaca panas.
                    </p>
                    <h6 class="text-warning fw-bold">Rp 12.000</h6>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in">
                <div class="glass-card">
                    <img src="{{ asset('foto/produk/produk4.jpg') }}" class="img-fluid rounded-4 mb-3" alt="Menu">
                    <h5 class="fw-bold">Chicken Steak</h5>
                    <p class="text-white-50 mb-2">
                        Steak ayam crispy dengan saus spesial dan kentang goreng.
                    </p>
                    <h6 class="text-warning fw-bold">Rp 35.000</h6>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="150">
                <div class="glass-card">
                    <img src="{{ asset('foto/produk/produk5.jpg') }}" class="img-fluid rounded-4 mb-3" alt="Menu">
                    <h5 class="fw-bold">Mie Ayam Bakso</h5>
                    <p class="text-white-50 mb-2">
                        Mie ayam gurih dengan topping bakso dan pangsit.
                    </p>
                    <h6 class="text-warning fw-bold">Rp 20.000</h6>
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="glass-card">
                    <img src="{{ asset('foto/produk/produk6.jpg') }}" class="img-fluid rounded-4 mb-3" alt="Menu">
                    <h5 class="fw-bold">Brownies Coklat</h5>
                    <p class="text-white-50 mb-2">
                        Brownies lembut dengan coklat premium dan topping kacang.
                    </p>
                    <h6 class="text-warning fw-bold">Rp 15.000</h6>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection