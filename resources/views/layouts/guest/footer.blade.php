<footer class="py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h4 class="fw-bold">
                    <i class="fa-solid fa-mug-hot text-warning"></i> CAFEPOS
                </h4>
                <p class="text-white-50">
                    CAFEPOS adalah aplikasi kasir modern untuk cafe & restoran.
                    Cepat, aman, dan mudah digunakan untuk transaksi, stok, dan laporan.
                </p>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold">Menu</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-white-50 text-decoration-none">Home</a></li>
                    <li><a href="{{ url('/menu') }}" class="text-white-50 text-decoration-none">Menu</a></li>
                    <li><a href="{{ url('/promo') }}" class="text-white-50 text-decoration-none">Promo</a></li>
                    <li><a href="{{ url('/tentang') }}" class="text-white-50 text-decoration-none">Tentang</a></li>
                    <li><a href="{{ url('/kontak') }}" class="text-white-50 text-decoration-none">Kontak</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <h5 class="fw-bold">Kontak</h5>
                <p class="text-white-50 mb-1"><i class="fa-solid fa-location-dot"></i> Indonesia</p>
                <p class="text-white-50 mb-1"><i class="fa-solid fa-phone"></i> +62 812-xxxx-xxxx</p>
                <p class="text-white-50"><i class="fa-solid fa-envelope"></i> cafepos@gmail.com</p>

                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-white fs-5"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#" class="text-white fs-5"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>

        <hr class="border-secondary mt-4">

        <div class="text-center text-white-50">
            <small>© {{ date('Y') }} CAFEPOS. All Rights Reserved.</small>
        </div>
    </div>
</footer>