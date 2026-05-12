<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'CAFEPOS Pelanggan')</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    {{-- GOOGLE FONT --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f7fb;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #111827;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
        }

        .sidebar-brand {
            color: white;
            font-size: 24px;
            font-weight: 700;
            text-decoration: none;
        }

        .sidebar .nav-link {
            color: #d1d5db;
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: 0.3s;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background: #1f2937;
            color: white;
        }

        .sidebar .nav-link.active {
            background: #f59e0b;
            color: white;
        }

        .content {
            margin-left: 260px;
            padding: 30px;
        }

        .topbar {
            background: white;
            border-radius: 18px;
            padding: 18px 24px;
            margin-bottom: 25px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #f59e0b;
        }

        @media (max-width: 991px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    {{-- SIDEBAR --}}
    <div class="sidebar px-3">

        <div class="text-center mb-4">
            <a href="{{ route('pelanggan.dashboard') }}" class="sidebar-brand">
                <i class="fa-solid fa-mug-hot text-warning"></i>
                CAFEPOS
            </a>
        </div>

        <ul class="nav flex-column">

            <li class="nav-item">
                <a href="{{ route('pelanggan.dashboard') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house me-2"></i>
                    Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('pelanggan.menu.index') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.menu.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-utensils me-2"></i>
                    Menu Cafe
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('pelanggan.keranjang.index') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.keranjang.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cart-shopping me-2"></i>
                    Keranjang
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('pelanggan.pesanan.index') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.pesanan.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt me-2"></i>
                    Pesanan Saya
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('pelanggan.wishlist.index') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.wishlist.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-heart me-2"></i>
                    Wishlist
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('pelanggan.ulasan.index') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.ulasan.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-star me-2"></i>
                    Ulasan
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('pelanggan.profil.index') }}"
                    class="nav-link {{ request()->routeIs('pelanggan.profil.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user me-2"></i>
                    Profil
                </a>
            </li>

            <hr class="text-secondary">

            <li class="nav-item">
                <a href="{{ route('pelanggan.logout') }}" class="nav-link text-danger">
                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                    Logout
                </a>
            </li>

        </ul>

    </div>

    {{-- CONTENT --}}
    <div class="content">

        {{-- TOPBAR --}}
        <div class="topbar d-flex justify-content-between align-items-center">

            <div>
                <h5 class="mb-0 fw-bold">
                    @yield('header', 'Dashboard Pelanggan')
                </h5>

                <small class="text-muted">
                    Selamat datang di CAFEPOS
                </small>
            </div>

            <div class="d-flex align-items-center gap-3">

                <div class="text-end">
                    <div class="fw-semibold">
                        {{ Auth::guard('pelanggan')->user()->name ?? 'Pelanggan' }}
                    </div>

                    <small class="text-muted">
                        Pelanggan
                    </small>
                </div>

                @if(Auth::guard('pelanggan')->user()?->foto)
                    <img src="{{ asset('storage/pelanggan/' . Auth::guard('pelanggan')->user()->foto) }}"
                        class="user-avatar">
                @else
                    <img src="https://cdn-icons-png.flaticon.com/512/847/847969.png"
                        class="user-avatar">
                @endif

            </div>

        </div>

        {{-- CONTENT --}}
        @yield('content')

    </div>

    {{-- JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>