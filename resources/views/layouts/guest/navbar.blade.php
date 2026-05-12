<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-blur py-3">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="fa-solid fa-mug-hot text-warning"></i> CAFEPOS
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMenu">

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 gap-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/menu') }}">Menu</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/promo') }}">Promo</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/tentang') }}">Tentang</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/kontak') }}">Kontak</a>
                </li>
            </ul>

            <div class="ms-lg-4 mt-3 mt-lg-0 d-flex gap-2">

                {{-- LOGIN ADMIN / KASIR --}}
                <a href="{{ route('auth.login') }}"
                    class="btn btn-outline-light px-4 py-2 rounded-pill">
                    <i class="fa-solid fa-user-shield"></i>
                    Login Staff
                </a>

                {{-- LOGIN PELANGGAN --}}
                <a href="{{ route('pelanggan.login') }}"
                    class="btn btn-gradient px-4 py-2 rounded-pill">
                    <i class="fa-solid fa-right-to-bracket"></i>
                    Login Pelanggan
                </a>

            </div>

        </div>
    </div>
</nav>