<aside class="main-sidebar sidebar-dark-primary elevation-4"
    style="background: linear-gradient(180deg,#0f172a,#111827);">

    <a href="{{ route('dashboard.manager') }}" class="brand-link text-center">
        <span class="brand-text font-weight-bold text-white">
            CAFEPOS <span class="text-warning">Manager</span>
        </span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2"
                    alt="User Image">
            </div>

            <div class="info">
                <a href="#" class="d-block text-white fw-bold">
                    {{ Auth::user()->name ?? 'Manager' }}
                </a>
                <small class="text-warning">
                    <i class="fas fa-shield-alt"></i> {{ Auth::user()->role ?? '-' }}
                </small>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard.manager') }}"
                        class="nav-link {{ request()->is('dashboardmanager') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header text-warning">INVENTORY</li>

                <li class="nav-item">
                    <a href="{{ route('inventory.bahanbaku.index') }}"
                        class="nav-link {{ request()->is('inventory/bahanbaku*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-seedling"></i>
                        <p>Bahan Baku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('inventory.stokmasuk.index') }}"
                        class="nav-link {{ request()->is('inventory/stokmasuk*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-arrow-down"></i>
                        <p>Stok Masuk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('inventory.stokkeluar.index') }}"
                        class="nav-link {{ request()->is('inventory/stokkeluar*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-arrow-up"></i>
                        <p>Stok Keluar</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('inventory.stok.index') }}"
                        class="nav-link {{ request()->is('inventory/stok*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Stok</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('inventory.pembelian.index') }}"
                        class="nav-link {{ request()->is('inventory/pembelian*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Pembelian</p>
                    </a>
                </li>
                <!-- LAPORAN -->
                <li class="nav-header text-warning">LAPORAN</li>

                @php
                $laporanActive =
                request()->is('laporan') ||
                request()->is('laporan/*');
                @endphp

                <li class="nav-item has-treeview {{ $laporanActive ? 'menu-open' : '' }}">

                    <a href="javascript:void(0)"
                        class="nav-link {{ $laporanActive ? 'active' : '' }}">

                        <i class="nav-icon fas fa-chart-line text-info"></i>

                        <p>
                            Menu Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>

                    </a>

                    <ul class="nav nav-treeview">

                        <!-- HARIAN -->
                        <li class="nav-item">
                            <a href="{{ route('laporan.harian.index') }}"
                                class="nav-link {{ request()->is('laporan/harian*') ? 'active' : '' }}">

                                <i class="far fa-calendar-day nav-icon text-success"></i>

                                <p>Laporan Harian</p>

                            </a>
                        </li>

                        <!-- BULANAN -->
                        <li class="nav-item">
                            <a href="{{ route('laporan.bulanan.index') }}"
                                class="nav-link {{ request()->is('laporan/bulanan*') ? 'active' : '' }}">

                                <i class="far fa-calendar-alt nav-icon text-warning"></i>

                                <p>Laporan Bulanan</p>

                            </a>
                        </li>

                        <!-- PRODUK -->
                        <li class="nav-item">
                            <a href="{{ route('laporan.produk.index') }}"
                                class="nav-link {{ request()->is('laporan/produk*') ? 'active' : '' }}">

                                <i class="fas fa-box-open nav-icon text-info"></i>

                                <p>Laporan Produk</p>

                            </a>
                        </li>

                        <!-- KASIR -->
                        <li class="nav-item">
                            <a href="{{ route('laporan.kasir.index') }}"
                                class="nav-link {{ request()->is('laporan/kasir*') ? 'active' : '' }}">

                                <i class="fas fa-user-tie nav-icon text-primary"></i>

                                <p>Laporan Kasir</p>

                            </a>
                        </li>

                        <!-- SHIFT -->
                        <li class="nav-item">
                            <a href="{{ route('laporan.shift.index') }}"
                                class="nav-link {{ request()->is('laporan/shift*') ? 'active' : '' }}">

                                <i class="fas fa-user-clock nav-icon text-danger"></i>

                                <p>Laporan Shift</p>

                            </a>
                        </li>

                        <!-- KEUNTUNGAN -->
                        <li class="nav-item">
                            <a href="{{ route('laporan.keuntungan.index') }}"
                                class="nav-link {{ request()->is('laporan/keuntungan*') ? 'active' : '' }}">

                                <i class="fas fa-coins nav-icon text-warning"></i>

                                <p>Laporan Keuntungan</p>

                            </a>
                        </li>

                    </ul>

                </li>

                <li class="nav-header text-warning">AKUN</li>

                <li class="nav-item">
                    <a href="{{ route('auth.logout') }}" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>