@extends('layouts.appmanager')

@section('title', 'Dashboard Manager')

@section('content')

<style>

    body{
        background: #f4f6f9;
    }

    .dashboard-hero{
        background: linear-gradient(135deg, #111827, #1e293b);
        border-radius: 24px;
        padding: 35px;
        color: white;
        position: relative;
        overflow: hidden;
        margin-bottom: 25px;
    }

    .dashboard-hero::before{
        content:'';
        position:absolute;
        right:-70px;
        top:-70px;
        width:220px;
        height:220px;
        background: rgba(255,255,255,0.05);
        border-radius:50%;
    }

    .dashboard-hero h1{
        font-size: 34px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .dashboard-hero p{
        opacity: .85;
        margin-bottom: 0;
    }

    .glass-badge{
        background: rgba(255,255,255,.12);
        padding: 12px 18px;
        border-radius: 14px;
        backdrop-filter: blur(10px);
        font-weight: 600;
        font-size: 14px;
    }

    .stat-card{
        border:none;
        border-radius:22px;
        overflow:hidden;
        position:relative;
        transition:.3s ease;
        color:white;
        min-height:180px;
    }

    .stat-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,.08);
    }

    .stat-card .card-body{
        padding:28px;
    }

    .stat-card h3{
        font-size:32px;
        font-weight:700;
        margin-bottom:10px;
    }

    .stat-card p{
        opacity:.9;
        margin-bottom:20px;
    }

    .stat-card .icon{
        position:absolute;
        right:20px;
        bottom:15px;
        font-size:60px;
        opacity:.15;
    }

    .gradient-primary{
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    .gradient-warning{
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .gradient-success{
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .gradient-danger{
        background: linear-gradient(135deg, #ef4444, #dc2626);
    }

    .btn-modern{
        border-radius:12px;
        padding:10px 14px;
        font-weight:600;
    }

    .modern-card{
        border:none;
        border-radius:22px;
        overflow:hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,.05);
    }

    .modern-card .card-header{
        background:white;
        border-bottom:1px solid #f1f5f9;
        padding:20px 25px;
    }

    .modern-card .card-body{
        padding:25px;
    }

    .section-title{
        font-weight:700;
        color:#111827;
        margin-bottom:0;
    }

    .table-modern th{
        background:#f8fafc;
        border-top:none;
        font-size:14px;
    }

    .table-modern td{
        vertical-align:middle;
    }

    .info-modern{
        border-radius:18px;
        padding:18px;
        background:#f8fafc;
        margin-bottom:18px;
        transition:.3s;
    }

    .info-modern:hover{
        background:#eef2ff;
    }

    .info-modern .icon-box{
        width:55px;
        height:55px;
        border-radius:16px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
        color:white;
    }

    .bg-soft-success{
        background: linear-gradient(135deg, #10b981, #059669);
    }

    .bg-soft-primary{
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
    }

    .bg-soft-warning{
        background: linear-gradient(135deg, #f59e0b, #d97706);
    }

    .stock-danger{
        background: rgba(239,68,68,.1);
        color:#dc2626;
        padding:8px 14px;
        border-radius:10px;
        font-weight:600;
    }

</style>


<div class="container-fluid">

    {{-- HERO --}}
    <div class="dashboard-hero shadow">

        <div class="d-flex justify-content-between align-items-center flex-wrap">

            <div>
                <h1>
                    <i class="fas fa-chart-line mr-2"></i>
                    Dashboard Manager
                </h1>

                <p>
                    Monitoring operasional cafe, penjualan, dan stok secara real-time.
                </p>
            </div>

            <div class="d-flex gap-2 flex-wrap mt-3 mt-md-0">

                <div class="glass-badge">
                    <i class="fas fa-calendar-alt mr-1"></i>
                    {{ date('d F Y') }}
                </div>

                <div class="glass-badge">
                    <i class="fas fa-user-clock mr-1"></i>
                    Shift Aktif : {{ $shiftAktif }}
                </div>

            </div>

        </div>

    </div>



    {{-- STATISTIC --}}
    <div class="row">

        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card stat-card gradient-primary shadow-sm">

                <div class="card-body">

                    <h3>{{ $totalProduk }}</h3>

                    <p>Total Produk</p>

                    <a href="{{ url('/master/produk') }}"
                       class="btn btn-light btn-sm btn-modern">
                        Lihat Produk
                    </a>

                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card stat-card gradient-warning shadow-sm">

                <div class="card-body">

                    <h3>{{ $totalKategori }}</h3>

                    <p>Total Kategori</p>

                    <a href="{{ url('/master/kategori') }}"
                       class="btn btn-light btn-sm btn-modern">
                        Lihat Kategori
                    </a>

                    <div class="icon">
                        <i class="fas fa-layer-group"></i>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card stat-card gradient-success shadow-sm">

                <div class="card-body">

                    <h3>
                        Rp {{ number_format($pendapatanHariIni ?? 0,0,',','.') }}
                    </h3>

                    <p>Pendapatan Hari Ini</p>

                    <a href="{{ url('/laporan') }}"
                       class="btn btn-light btn-sm btn-modern">
                        Detail Laporan
                    </a>

                    <div class="icon">
                        <i class="fas fa-wallet"></i>
                    </div>

                </div>

            </div>

        </div>


        <div class="col-lg-3 col-md-6 mb-4">

            <div class="card stat-card gradient-danger shadow-sm">

                <div class="card-body">

                    <h3>{{ $penjualanHariIni }}</h3>

                    <p>Transaksi Hari Ini</p>

                    <a href="{{ url('/laporan') }}"
                       class="btn btn-light btn-sm btn-modern">
                        Lihat Transaksi
                    </a>

                    <div class="icon">
                        <i class="fas fa-receipt"></i>
                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- ROW --}}
    <div class="row">

        {{-- PRODUK TERLARIS --}}
        <div class="col-lg-8 mb-4">

            <div class="card modern-card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="section-title">
                        <i class="fas fa-fire text-danger mr-2"></i>
                        Produk Terlaris Hari Ini
                    </h5>

                    <span class="badge badge-danger px-3 py-2">
                        TOP SALES
                    </span>

                </div>

                <div class="card-body p-0">

                    @if($produkTerlaris->count() > 0)

                        <div class="table-responsive">

                            <table class="table table-hover table-modern mb-0">

                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-right">Pendapatan</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    @foreach($produkTerlaris as $p)

                                        <tr>

                                            <td>
                                                <div class="font-weight-bold">
                                                    {{ $p->namaproduk }}
                                                </div>
                                            </td>

                                            <td class="text-center">

                                                <span class="badge badge-primary px-3 py-2">
                                                    {{ $p->total_qty }}
                                                </span>

                                            </td>

                                            <td class="text-right font-weight-bold text-success">

                                                Rp {{ number_format($p->total_pendapatan,0,',','.') }}

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="text-center py-5 text-muted">

                            <i class="fas fa-chart-bar fa-3x mb-3"></i>

                            <p class="mb-0">
                                Belum ada transaksi hari ini.
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>



        {{-- SUMMARY --}}
        <div class="col-lg-4 mb-4">

            <div class="card modern-card h-100">

                <div class="card-header">

                    <h5 class="section-title">
                        <i class="fas fa-chart-pie text-success mr-2"></i>
                        Ringkasan Bulan Ini
                    </h5>

                </div>

                <div class="card-body">

                    <div class="info-modern d-flex align-items-center">

                        <div class="icon-box bg-soft-success mr-3">
                            <i class="fas fa-coins"></i>
                        </div>

                        <div>
                            <small class="text-muted">
                                Pendapatan Bulan Ini
                            </small>

                            <h5 class="font-weight-bold text-success mb-0">
                                Rp {{ number_format($pendapatanBulanIni,0,',','.') }}
                            </h5>
                        </div>

                    </div>


                    <div class="info-modern d-flex align-items-center">

                        <div class="icon-box bg-soft-primary mr-3">
                            <i class="fas fa-chair"></i>
                        </div>

                        <div>
                            <small class="text-muted">
                                Total Meja
                            </small>

                            <h5 class="font-weight-bold mb-0">
                                {{ $totalMeja }}
                            </h5>
                        </div>

                    </div>


                    <div class="info-modern d-flex align-items-center mb-0">

                        <div class="icon-box bg-soft-warning mr-3">
                            <i class="fas fa-users"></i>
                        </div>

                        <div>
                            <small class="text-muted">
                                Total Kasir
                            </small>

                            <h5 class="font-weight-bold mb-0">
                                {{ $totalKasir }}
                            </h5>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



    {{-- STOK MENIPIS --}}
    <div class="card modern-card mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="section-title">

                <i class="fas fa-exclamation-triangle text-danger mr-2"></i>

                Stok Menipis

            </h5>

            <span class="badge badge-danger px-3 py-2">
                PERLU RESTOK
            </span>

        </div>

        <div class="card-body p-0">

            @if($stokMenipis->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover table-modern mb-0">

                        <thead>

                            <tr>
                                <th>Bahan Baku</th>
                                <th class="text-center">Stok Tersedia</th>
                                <th class="text-center">Stok Minimal</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($stokMenipis as $s)

                                <tr>

                                    <td class="font-weight-bold">
                                        {{ $s->namabahan }}
                                    </td>

                                    <td class="text-center">

                                        <span class="stock-danger">
                                            {{ $s->stoktersedia }}
                                        </span>

                                    </td>

                                    <td class="text-center">

                                        <span class="badge badge-danger px-3 py-2">
                                            {{ $s->stokminimal }}
                                        </span>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5 text-muted">

                    <i class="fas fa-check-circle fa-3x text-success mb-3"></i>

                    <h5>Semua stok masih aman</h5>

                    <p class="mb-0">
                        Tidak ada bahan baku yang perlu direstok saat ini.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection