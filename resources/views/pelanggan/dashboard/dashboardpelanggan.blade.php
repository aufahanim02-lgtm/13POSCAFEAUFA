@extends('layouts.apppelanggan')

@section('title', 'Dashboard Pelanggan')

@section('content')

<style>
    body {
        background: #f4f7fb;
    }

    .dashboard-hero {
        background: linear-gradient(135deg, #111827, #1e293b);
        border-radius: 30px;
        padding: 40px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .dashboard-hero::before {
        content: '';
        position: absolute;
        width: 260px;
        height: 260px;
        background: rgba(255, 255, 255, .05);
        border-radius: 50%;
        right: -70px;
        top: -70px;
    }

    .dashboard-hero h2 {
        font-weight: 700;
        margin-bottom: 10px;
    }

    .dashboard-hero p {
        opacity: .85;
        margin-bottom: 0;
    }

    .profile-card {
        background: white;
        border: none;
        border-radius: 28px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .06);
        height: 100%;
    }

    .profile-top {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        height: 120px;
        position: relative;
    }

    .profile-avatar {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid white;
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: -55px;
        background: white;
    }

    .profile-body {
        padding: 70px 30px 30px;
        text-align: center;
    }

    .profile-name {
        font-size: 24px;
        font-weight: 700;
        color: #111827;
    }

    .profile-email {
        color: #6b7280;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .member-badge {
        background: #dcfce7;
        color: #166534;
        padding: 10px 18px;
        border-radius: 14px;
        font-weight: 600;
        display: inline-block;
    }

    .modern-card {
        border: none;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        background: white;
    }

    .stat-card {
        padding: 25px;
        position: relative;
        overflow: hidden;
    }

    .stat-card .icon {
        position: absolute;
        right: 20px;
        bottom: 10px;
        font-size: 60px;
        opacity: .10;
    }

    .stat-card h3 {
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .bg-primary-gradient {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
    }

    .bg-success-gradient {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }

    .bg-warning-gradient {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
    }

    .bg-danger-gradient {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
    }

    .section-title {
        font-weight: 700;
        color: #111827;
    }

    .table-modern thead th {
        background: #f8fafc;
        border-top: none;
        font-size: 14px;
    }

    .table-modern td {
        vertical-align: middle;
    }

    .quick-menu {
        text-decoration: none;
        display: block;
        background: white;
        border-radius: 22px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 8px 25px rgba(0, 0, 0, .05);
        transition: .3s;
        color: #111827;
        height: 100%;
    }

    .quick-menu:hover {
        transform: translateY(-5px);
        text-decoration: none;
        color: #2563eb;
    }

    .quick-menu i {
        font-size: 38px;
        margin-bottom: 15px;
    }

    .quick-menu h6 {
        font-weight: 700;
        margin-bottom: 5px;
    }
</style>


<div class="container py-4">

    {{-- HERO --}}
    <div class="dashboard-hero shadow">

        <div class="row align-items-center">

            <div class="col-lg-8">

                <h2>
                    👋 Selamat Datang,
                    {{ $pelanggan->name ?? 'Pelanggan' }}
                </h2>

                <p>
                    Nikmati pengalaman pemesanan cafe yang cepat,
                    nyaman, dan modern langsung dari dashboard pelanggan.
                </p>

            </div>

            <div class="col-lg-4 text-lg-right mt-4 mt-lg-0">

                <a href="{{ url('/pelanggan/menu') }}"
                    class="btn btn-light btn-lg shadow-sm px-4">

                    <i class="fas fa-shopping-cart mr-2"></i>
                    Pesan Menu

                </a>

            </div>

        </div>

    </div>



    <div class="row">

        {{-- PROFILE --}}
        <div class="col-lg-4 mb-4">

            <div class="profile-card">

                <div class="profile-top">
                    {{-- FOTO --}}
                    @if($pelanggan && $pelanggan->foto)
                    <img src="{{ asset('storage/pelanggan/' . $pelanggan->foto) }}"
                        class="rounded-circle shadow"
                        style="width:140px;height:140px;object-fit:cover;">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($pelanggan->name ?? 'Pelanggan') }}&background=111827&color=fff"
                        class="rounded-circle shadow"
                        style="width:140px;height:140px;object-fit:cover;">
                    @endif

                </div>

                <div class="profile-body">

                    <div class="profile-name">
                        {{ $pelanggan->name ?? '-' }}
                    </div>

                    <div class="profile-email">
                        {{ $pelanggan->email ?? '-' }}
                    </div>

                    <div class="member-badge mb-4">
                        ⭐ Member Aktif
                    </div>

                    <div class="row text-center">

                        <div class="col-6 border-right">
                            <h5 class="fw-bold mb-1">
                                {{ $totalPesanan }}
                            </h5>
                            <small class="text-muted">
                                Total Pesanan
                            </small>
                        </div>

                        <div class="col-6">
                            <h5 class="fw-bold mb-1 text-success">
                                {{ $pelanggan->point ?? 0 }}
                            </h5>
                            <small class="text-muted">
                                Point
                            </small>
                        </div>

                    </div>

                </div>

            </div>

        </div>



        {{-- STATISTIK --}}
        <div class="col-lg-8">

            <div class="row">

                <div class="col-md-6 mb-4">

                    <div class="modern-card stat-card bg-primary-gradient">

                        <small>Total Pesanan</small>

                        <h3>{{ $totalPesanan }}</h3>

                        <div class="icon">
                            <i class="fas fa-shopping-bag"></i>
                        </div>

                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <div class="modern-card stat-card bg-warning-gradient">

                        <small>Pesanan Aktif</small>

                        <h3>{{ $pesananAktif }}</h3>

                        <div class="icon">
                            <i class="fas fa-clock"></i>
                        </div>

                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <div class="modern-card stat-card bg-success-gradient">

                        <small>Point Member</small>

                        <h3>{{ $pelanggan->point ?? 0 }}</h3>

                        <div class="icon">
                            <i class="fas fa-star"></i>
                        </div>

                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <div class="modern-card stat-card bg-danger-gradient">

                        <small>Promo Aktif</small>

                        <h3>{{ $promoAktif }}</h3>

                        <div class="icon">
                            <i class="fas fa-tags"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- QUICK MENU --}}
    <div class="mb-4">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>
                <h4 class="section-title mb-1">
                    Quick Access
                </h4>

                <small class="text-muted">
                    Akses cepat fitur pelanggan
                </small>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-3 col-md-6 mb-4">

                <a href="{{ url('/pelanggan/menu') }}"
                    class="quick-menu">

                    <i class="fas fa-utensils text-primary"></i>

                    <h6>Menu Cafe</h6>

                    <small class="text-muted">
                        Lihat semua menu makanan & minuman
                    </small>

                </a>

            </div>


            <div class="col-lg-3 col-md-6 mb-4">

                <a href="{{ url('/pelanggan/pesanan') }}"
                    class="quick-menu">

                    <i class="fas fa-receipt text-success"></i>

                    <h6>Pesanan Saya</h6>

                    <small class="text-muted">
                        Cek riwayat dan status pesanan
                    </small>

                </a>

            </div>


            <div class="col-lg-3 col-md-6 mb-4">

                <a href="{{ url('/pelanggan/profile') }}"
                    class="quick-menu">

                    <i class="fas fa-user-circle text-warning"></i>

                    <h6>Profile</h6>

                    <small class="text-muted">
                        Kelola akun pelanggan anda
                    </small>

                </a>

            </div>


            <div class="col-lg-3 col-md-6 mb-4">

                <a href="{{ url('/pelanggan/promo') }}"
                    class="quick-menu">

                    <i class="fas fa-gift text-danger"></i>

                    <h6>Promo</h6>

                    <small class="text-muted">
                        Lihat promo dan diskon terbaru
                    </small>

                </a>

            </div>

        </div>

    </div>



    {{-- RIWAYAT PESANAN --}}
    <div class="modern-card">

        <div class="card-header bg-white border-0 p-4 d-flex justify-content-between align-items-center">

            <div>

                <h5 class="mb-1 fw-bold">
                    Riwayat Pesanan
                </h5>

                <small class="text-muted">
                    Transaksi terbaru pelanggan
                </small>

            </div>

            <a href="{{ url('/pelanggan/pesanan') }}"
                class="btn btn-outline-primary">

                Lihat Semua

            </a>

        </div>

        <div class="card-body p-0">

            @if($riwayat->count() > 0)

            <div class="table-responsive">

                <table class="table table-hover table-modern mb-0">

                    <thead>

                        <tr>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Pembayaran</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($riwayat as $row)

                        <tr>

                            <td class="fw-bold">
                                {{ $row->kodeinvoice }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($row->tanggalpenjualan)->format('d-m-Y H:i') }}
                            </td>

                            <td>

                                @if($row->statuspesanan == 'menunggu')

                                <span class="badge bg-warning text-dark">
                                    Menunggu
                                </span>

                                @elseif($row->statuspesanan == 'diproses')

                                <span class="badge bg-info">
                                    Diproses
                                </span>

                                @elseif($row->statuspesanan == 'siapdiambil')

                                <span class="badge bg-primary">
                                    Siap
                                </span>

                                @else

                                <span class="badge bg-success">
                                    Selesai
                                </span>

                                @endif

                            </td>

                            <td>

                                @if($row->statuspembayaran == 'lunas')

                                <span class="badge bg-success">
                                    Lunas
                                </span>

                                @else

                                <span class="badge bg-danger">
                                    Belum Bayar
                                </span>

                                @endif

                            </td>

                            <td class="fw-bold text-success">
                                Rp {{ number_format($row->total,0,',','.') }}
                            </td>

                            <td>

                                <a href="{{ url('/pelanggan/pesanan/detail/'.$row->id) }}"
                                    class="btn btn-sm btn-primary">

                                    Detail

                                </a>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

            @else

            <div class="text-center py-5">

                <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
                    width="110"
                    class="mb-3">

                <h5 class="fw-bold">
                    Belum ada pesanan
                </h5>

                <p class="text-muted">
                    Yuk mulai pesan menu favorit kamu sekarang.
                </p>

                <a href="{{ url('/pelanggan/menu') }}"
                    class="btn btn-primary">

                    Mulai Pesan

                </a>

            </div>

            @endif

        </div>

    </div>

</div>

@endsection