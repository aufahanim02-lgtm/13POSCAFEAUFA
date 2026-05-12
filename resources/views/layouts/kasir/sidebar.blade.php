<aside class="main-sidebar elevation-4"
    style="background: rgba(10,10,15,0.95); border-right: 1px solid rgba(255,0,76,0.20);">

    {{-- BRAND LOGO --}}
    <a href="{{ route('dashboard.kasir') }}" class="brand-link text-center"
        style="background: rgba(255,0,76,0.08); border-bottom: 1px solid rgba(255,0,76,0.20);">
        <span class="brand-text font-weight-light text-white">
            <b>CAFEPOS</b> Kasir
        </span>
    </a>

    <div class="sidebar">

        {{-- USER PANEL --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">

            <div class="image">
                @if(Auth::user() && Auth::user()->foto)
                <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                    style="width:40px; height:40px; object-fit:cover;">
                @else
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                    style="width:40px; height:40px; object-fit:cover;">
                @endif
            </div>

            <div class="info">
                <a href="#" class="d-block text-white fw-bold">
                    {{ Auth::user()->name ?? 'Kasir' }}
                </a>
                <small style="color: rgba(255,255,255,0.60);">
                    Role: {{ strtoupper(Auth::user()->role ?? '-') }}
                </small>
            </div>

        </div>

        {{-- SEARCH --}}
        <div class="form-inline mb-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar"
                    type="search"
                    placeholder="Cari menu..."
                    aria-label="Search"
                    style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.10); color:white;">
                <div class="input-group-append">
                    <button class="btn btn-sidebar"
                        style="background: rgba(255,0,76,0.15); border: 1px solid rgba(255,0,76,0.25); color:white;">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- MENU --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                {{-- DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard.kasir') }}"
                        class="nav-link {{ request()->routeIs('dashboard.kasir') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header" style="color: rgba(255,255,255,0.45);">
                    TRANSAKSI
                </li>

                {{-- POS --}}
                <li class="nav-item">
                    <a href="{{ route('kasir.pos') }}"
                        class="nav-link {{ request()->routeIs('kasir.pos') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cash-register"></i>
                        <p>POS Kasir</p>
                    </a>
                </li>

                {{-- PESANAN MASUK --}}
                <li class="nav-item">
                    <a href="{{ route('kasir.pesananmasuk.index') }}"
                        class="nav-link {{ request()->routeIs('kasir.pesananmasuk.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-inbox"></i>
                        <p>
                            Pesanan Masuk

                            @if(isset($jumlahPesananMasuk) && $jumlahPesananMasuk > 0)
                            <span class="badge badge-danger right"
                                style="background:#ff004c; font-size:12px;">
                                {{ $jumlahPesananMasuk }}
                            </span>
                            @endif
                        </p>
                    </a>
                </li>

                {{-- PEMBAYARAN PESANAN PELANGGAN --}}
                <li class="nav-item">
                    <a href="{{ route('kasir.pembayaran.index') }}"
                        class="nav-link {{ request()->routeIs('kasir.pembayaran.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Pembayaran</p>
                    </a>
                </li>
                {{-- PEMBAYARAN PESANAN PELANGGAN --}}
                <li class="nav-item">
                    <a href="{{ route('kasir.pembayaranpelanggan.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Pembayaran Pelanggan</p>
                    </a>
                </li>
                {{-- CETAK STRUK --}}
                <li class="nav-item">
                    <a href="{{ route('kasir.cetakstruk.index') }}"
                        class="nav-link {{ request()->routeIs('kasir.cetakstruk.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>Cetak Struk</p>
                    </a>
                </li>

                {{-- RIWAYAT --}}
                <li class="nav-item">
                    <a href="{{ route('kasir.riwayat.index') }}"
                        class="nav-link {{ request()->routeIs('kasir.riwayat.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Riwayat Transaksi</p>
                    </a>
                </li>

                <li class="nav-header" style="color: rgba(255,255,255,0.45);">
                    SHIFT
                </li>

                {{-- SHIFT --}}
                <li class="nav-item">
                    <a href="{{ route('kasir.shift.index') }}"
                        class="nav-link {{ request()->routeIs('kasir.shift.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-clock"></i>
                        <p>Shift</p>
                    </a>
                </li>

                
            </ul>
        </nav>

    </div>
</aside>