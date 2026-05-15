@extends('layouts.appadmin')

@section('title', 'Dashboard Owner')

@section('content')

<style>
    .dashboard-header {
        background: linear-gradient(135deg, #111827, #1f2937);
        border-radius: 20px;
        padding: 30px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
    }

    .dashboard-header::before {
        content: '';
        position: absolute;
        right: -50px;
        top: -50px;
        width: 200px;
        height: 200px;
        background: rgba(255,255,255,0.05);
        border-radius: 50%;
    }

    .dashboard-header h1 {
        font-weight: 700;
        font-size: 32px;
    }

    .dashboard-header p {
        opacity: .9;
        margin-bottom: 0;
    }

    .modern-card {
        border: none;
        border-radius: 18px;
        overflow: hidden;
        transition: all .3s ease;
        background: #fff;
    }

    .modern-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.08);
    }

    .stat-card {
        position: relative;
        padding: 25px;
        color: white;
        min-height: 160px;
    }

    .stat-card .icon {
        position: absolute;
        right: 20px;
        bottom: 15px;
        font-size: 55px;
        opacity: .2;
    }

    .stat-card h3 {
        font-size: 34px;
        font-weight: 700;
    }

    .stat-card p {
        margin-bottom: 15px;
        font-size: 15px;
        opacity: .95;
    }

    .bg-gradient-info {
        background: linear-gradient(135deg, #06b6d4, #2563eb);
    }

    .bg-gradient-success {
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .bg-gradient-warning {
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .bg-gradient-danger {
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .dashboard-btn {
        border-radius: 12px;
        padding: 12px;
        font-weight: 600;
        transition: .3s;
    }

    .dashboard-btn:hover {
        transform: scale(1.03);
    }

    .table-modern th {
        border-top: none;
        background: #f8fafc;
    }

    .quick-menu {
        transition: .3s;
        border-radius: 16px;
    }

    .quick-menu:hover {
        transform: translateY(-4px);
    }

    .quick-menu i {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .section-title {
        font-weight: 700;
        color: #111827;
    }

    .glass-badge {
        background: rgba(255,255,255,0.15);
        padding: 10px 16px;
        border-radius: 12px;
        backdrop-filter: blur(10px);
    }
</style>

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="dashboard-header shadow">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>
                <h1>
                    <i class="fas fa-chart-pie mr-2"></i>
                    Dashboard Owner
                </h1>

                <p>
                    Selamat datang kembali,
                    <b>{{ Auth::user()->name ?? 'Owner' }}</b>
                    👋
                </p>
            </div>

            <div class="glass-badge mt-3 mt-md-0">
                <i class="fas fa-calendar-alt mr-1"></i>
                {{ now()->format('d F Y') }}
            </div>

        </div>

    </div>


    {{-- STATISTIK --}}
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="modern-card stat-card bg-gradient-info shadow-sm">

                <h3>{{ $totalProduk ?? 0 }}</h3>
                <p>Total Produk</p>

                <a href="{{ route('master.produk.index') }}"
                   class="btn btn-light btn-sm dashboard-btn">
                    Kelola Produk
                </a>

                <div class="icon">
                    <i class="fas fa-box"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="modern-card stat-card bg-gradient-success shadow-sm">

                <h3>{{ $totalKategori ?? 0 }}</h3>
                <p>Total Kategori</p>

                <a href="{{ route('master.kategori.index') }}"
                   class="btn btn-light btn-sm dashboard-btn">
                    Kelola Kategori
                </a>

                <div class="icon">
                    <i class="fas fa-layer-group"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="modern-card stat-card bg-gradient-warning shadow-sm">

                <h3>{{ $totalMeja ?? 0 }}</h3>
                <p>Total Meja</p>

                <a href="{{ route('master.meja.index') }}"
                   class="btn btn-light btn-sm dashboard-btn">
                    Kelola Meja
                </a>

                <div class="icon">
                    <i class="fas fa-chair"></i>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="modern-card stat-card bg-gradient-danger shadow-sm">

                <h3>{{ $totalUser ?? 0 }}</h3>
                <p>Total User</p>

                <a href="{{ route('master.user.index') }}"
                   class="btn btn-light btn-sm dashboard-btn">
                    Kelola User
                </a>

                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>

            </div>
        </div>

    </div>


    {{-- RINGKASAN --}}
    <div class="row">

        {{-- PENJUALAN --}}
        <div class="col-lg-6 mb-4">

            <div class="card modern-card shadow-sm h-100">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="section-title mb-0">
                        <i class="fas fa-chart-line text-primary mr-2"></i>
                        Ringkasan Penjualan Hari Ini
                    </h5>
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-4">
                        <span>Total Transaksi</span>
                        <b>{{ $transaksiHariIni ?? 0 }}</b>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span>Total Pendapatan</span>
                        <b class="text-success">
                            Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}
                        </b>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span>Total Diskon</span>
                        <b class="text-warning">
                            Rp {{ number_format($diskonHariIni ?? 0, 0, ',', '.') }}
                        </b>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Total Pajak</span>
                        <b class="text-info">
                            Rp {{ number_format($pajakHariIni ?? 0, 0, ',', '.') }}
                        </b>
                    </div>

                </div>

            </div>

        </div>


        {{-- SHIFT --}}
        <div class="col-lg-6 mb-4">

            <div class="card modern-card shadow-sm h-100">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="section-title mb-0">
                        <i class="fas fa-user-clock text-success mr-2"></i>
                        Shift Aktif
                    </h5>
                </div>

                <div class="card-body">

                    @if(isset($shiftAktif) && $shiftAktif)

                        <div class="mb-3">
                            <small class="text-muted">Kasir</small>
                            <h5>{{ $shiftAktif->user->name ?? '-' }}</h5>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">Jam Mulai</small>
                            <h6>{{ $shiftAktif->shiftmulai ?? '-' }}</h6>
                        </div>

                        <div class="mb-4">
                            <small class="text-muted">Saldo Awal</small>
                            <h4 class="text-success">
                                Rp {{ number_format($shiftAktif->saldoawal ?? 0, 0, ',', '.') }}
                            </h4>
                        </div>

                        <span class="badge badge-success p-2">
                            <i class="fas fa-check-circle"></i>
                            SHIFT OPEN
                        </span>

                    @else

                        <div class="text-center py-5 text-muted">
                            <i class="fas fa-user-slash fa-3x mb-3"></i>
                            <p>Tidak ada shift aktif saat ini.</p>
                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>


    {{-- LAPORAN --}}
    <div class="card modern-card shadow-sm mb-4">

        <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between align-items-center">

            <h5 class="section-title mb-0">
                <i class="fas fa-file-alt text-primary mr-2"></i>
                5 Laporan Terbaru
            </h5>

            <a href="{{ route('laporan.index') }}"
               class="btn btn-primary btn-sm">
                <i class="fas fa-folder-open"></i>
                Semua Laporan
            </a>

        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover table-modern mb-0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Jenis</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @if(isset($laporanTerbaru) && count($laporanTerbaru) > 0)

                            @foreach($laporanTerbaru as $item)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <span class="badge badge-info px-3 py-2">
                                            {{ $item['jenis'] }}
                                        </span>
                                    </td>

                                    <td>{{ $item['tanggal'] }}</td>

                                    <td class="font-weight-bold text-success">
                                        Rp {{ number_format($item['total'] ?? 0, 0, ',', '.') }}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ $item['route'] }}"
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i>
                                            Detail
                                        </a>
                                    </td>

                                </tr>

                            @endforeach

                        @else

                            <tr>
                                <td colspan="5" class="text-center text-muted py-5">
                                    <i class="fas fa-folder-open fa-2x mb-2"></i>
                                    <br>
                                    Belum ada laporan terbaru.
                                </td>
                            </tr>

                        @endif

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- QUICK ACCESS --}}
    <div class="card modern-card shadow-sm">

        <div class="card-header bg-white border-0 pt-4">
            <h5 class="section-title mb-0">
                <i class="fas fa-bolt text-warning mr-2"></i>
                Quick Access
            </h5>
        </div>

        <div class="card-body">

            <div class="row text-center">

                <div class="col-md-2 col-6 mb-4">
                    <a href="{{ route('master.produk.index') }}"
                       class="btn btn-info btn-block quick-menu shadow-sm p-4">
                        <i class="fas fa-box"></i>
                        <div>Produk</div>
                    </a>
                </div>

                <div class="col-md-2 col-6 mb-4">
                    <a href="{{ route('master.kategori.index') }}"
                       class="btn btn-success btn-block quick-menu shadow-sm p-4">
                        <i class="fas fa-list"></i>
                        <div>Kategori</div>
                    </a>
                </div>

                <div class="col-md-2 col-6 mb-4">
                    <a href="{{ route('master.meja.index') }}"
                       class="btn btn-warning btn-block quick-menu shadow-sm p-4">
                        <i class="fas fa-chair"></i>
                        <div>Meja</div>
                    </a>
                </div>

                <div class="col-md-2 col-6 mb-4">
                    <a href="{{ route('master.user.index') }}"
                       class="btn btn-danger btn-block quick-menu shadow-sm p-4">
                        <i class="fas fa-users"></i>
                        <div>User</div>
                    </a>
                </div>

                <div class="col-md-2 col-6 mb-4">
                    <a href="{{ route('laporan.index') }}"
                       class="btn btn-primary btn-block quick-menu shadow-sm p-4">
                        <i class="fas fa-file-alt"></i>
                        <div>Laporan</div>
                    </a>
                </div>

                <div class="col-md-2 col-6 mb-4">
                    <a href="{{ route('loginhistory.index') }}"
                       class="btn btn-secondary btn-block quick-menu shadow-sm p-4">
                        <i class="fas fa-history"></i>
                        <div>History</div>
                    </a>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection