<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- BRAND LOGO -->
    <a href="{{ route('dashboard.owner') }}" class="brand-link text-center">
        <span class="brand-text font-weight-bold text-white">
            CAFEPOS <span class="text-warning">Owner</span>
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- USER PANEL -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
            <div class="image">
                @if(Auth::user()->foto)
                <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                    style="width:35px; height:35px; object-fit:cover;">
                @else
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}"
                    class="img-circle elevation-2"
                    alt="User Image"
                    style="width:35px; height:35px; object-fit:cover;">
                @endif
            </div>

            <div class="info">
                <a href="#" class="d-block text-white font-weight-bold">
                    {{ Auth::user()->name ?? 'Owner' }}
                </a>
                <small class="text-warning">
                    <i class="fas fa-shield-alt"></i> {{ Auth::user()->role ?? '-' }}
                </small>
            </div>
        </div>

        <!-- SEARCH -->
        <div class="form-inline mb-3">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar"
                    type="search"
                    placeholder="Cari menu..."
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- MENU -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">

                <!-- DASHBOARD -->
                <li class="nav-item">
                    <a href="{{ route('dashboard.owner') }}"
                        class="nav-link {{ request()->is('dashboardowner') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- LOGIN HISTORY -->
                <li class="nav-item">
                    <a href="{{ route('loginhistory.index') }}"
                        class="nav-link {{ request()->is('loginhistory*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-history"></i>
                        <p>Login History</p>
                    </a>
                </li>

                <!-- MASTER DATA -->
                <li class="nav-header text-warning">MASTER DATA</li>

                <li class="nav-item">
                    <a href="{{ route('master.user.index') }}"
                        class="nav-link {{ request()->is('master/user*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>User</p>
                    </a>
                </li>

                <!-- DATA PELANGGAN -->
                <li class="nav-item">
                    <a href="{{ route('admin.pelanggan.index') }}"
                        class="nav-link {{ request()->is('admin/pelanggan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Data Pelanggan</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('master.kategori.index') }}"
                        class="nav-link {{ request()->is('master/kategori*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>Kategori</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('master.produk.index') }}"
                        class="nav-link {{ request()->is('master/produk*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Produk</p>
                    </a>
                </li>

                <!-- RESEP PRODUK -->
                <li class="nav-item">
                    <a href="{{ route('master.resep.index') }}"
                        class="nav-link {{ request()->is('master/resep*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Resep Produk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('master.meja.index') }}"
                        class="nav-link {{ request()->is('master/meja*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chair"></i>
                        <p>Meja</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('master.supplier.index') }}"
                        class="nav-link {{ request()->is('master/supplier*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Supplier</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('master.metodepembayaran.index') }}"
                        class="nav-link {{ request()->is('master/metodepembayaran*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>Metode Pembayaran</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('master.promo.index') }}"
                        class="nav-link {{ request()->is('master/promo*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Promo</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('master.pajak.index') }}"
                        class="nav-link {{ request()->is('master/pajak*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-percent"></i>
                        <p>Pajak</p>
                    </a>
                </li>

                <!-- INVENTORY -->
                <li class="nav-header text-warning">INVENTORY</li>

                <li class="nav-item">
                    <a href="{{ route('inventory.bahanbaku.index') }}"
                        class="nav-link {{ request()->is('inventory/bahanbaku*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-seedling"></i>
                        <p>Bahan Baku</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('inventory.stok.index') }}"
                        class="nav-link {{ request()->is('inventory/stok*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-warehouse"></i>
                        <p>Stok</p>
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
                    <a href="{{ route('inventory.pembelian.index') }}"
                        class="nav-link {{ request()->is('inventory/pembelian*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Pembelian</p>
                    </a>
                </li>

                <!-- TRANSAKSI -->
                <li class="nav-header text-warning">TRANSAKSI</li>

                <li class="nav-item">
                    <a href="{{ route('transaksi.riwayat.index') }}"
                        class="nav-link {{ request()->is('transaksi/riwayat*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>Riwayat Transaksi</p>
                    </a>
                </li>

                <!-- ULASAN -->
                <li class="nav-item">
                    <a href="{{ route('admin.ulasan.index') }}"
                        class="nav-link {{ request()->is('admin/ulasan*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p>Ulasan Pelanggan</p>
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
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Menu Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{ route('laporan.harian.index') }}"
                                class="nav-link {{ request()->is('laporan/harian*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Harian</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('laporan.bulanan.index') }}"
                                class="nav-link {{ request()->is('laporan/bulanan*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Bulanan</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('laporan.produk.index') }}"
                                class="nav-link {{ request()->is('laporan/produk*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Produk</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('laporan.kasir.index') }}"
                                class="nav-link {{ request()->is('laporan/kasir*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kasir</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('laporan.shift.index') }}"
                                class="nav-link {{ request()->is('laporan/shift*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Shift</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('laporan.keuntungan.index') }}"
                                class="nav-link {{ request()->is('laporan/keuntungan*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Keuntungan</p>
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>
        </nav>

    </div>
</aside>