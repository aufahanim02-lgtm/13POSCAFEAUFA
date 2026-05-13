@extends('layouts.appmanager')
@section('title', 'Dashboard Manager')

@section('content')

    <!-- HEADER -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">

                <div>
                    <h1 class="fw-bold mb-0">Dashboard Manager</h1>
                    <small class="text-muted">
                        Monitoring operasional cafe hari ini
                    </small>
                </div>

                <div class="mt-2 mt-md-0 d-flex gap-2 flex-wrap">
                    <span class="badge badge-info px-3 py-2 shadow-sm">
                        <i class="fas fa-calendar-alt"></i> {{ date('d M Y') }}
                    </span>

                    <span class="badge badge-success px-3 py-2 shadow-sm">
                        <i class="fas fa-user-clock"></i> Shift Aktif: {{ $shiftAktif }}
                    </span>
                </div>

            </div>
        </div>
    </section>


    <!-- MAIN -->
    <section class="content">
        <div class="container-fluid">

            <!-- STAT BOX -->
            <div class="row">

                <div class="col-lg-3 col-md-6 col-12">
                    <div class="small-box bg-primary shadow-sm rounded">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $totalProduk }}</h3>
                            <p class="mb-0">Total Produk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <a href="{{ url('/master/produk') }}" class="small-box-footer">
                            Lihat Produk <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <div class="small-box bg-warning shadow-sm rounded">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $totalKategori }}</h3>
                            <p class="mb-0">Total Kategori</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <a href="{{ url('/master/kategori') }}" class="small-box-footer">
                            Lihat Kategori <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <div class="small-box bg-success shadow-sm rounded">
                        <div class="inner">
                            <h3 class="fw-bold">
                                {{ $pendapatanHariIni > 0 ? 'Rp '.number_format($pendapatanHariIni) : 'Rp 0' }}
                            </h3>
                            <p class="mb-0">Pendapatan Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <a href="{{ url('/laporan') }}" class="small-box-footer">
                            Detail Laporan <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-12">
                    <div class="small-box bg-danger shadow-sm rounded">
                        <div class="inner">
                            <h3 class="fw-bold">{{ $penjualanHariIni }}</h3>
                            <p class="mb-0">Transaksi Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-receipt"></i>
                        </div>
                        <a href="{{ url('/laporan') }}" class="small-box-footer">
                            Lihat Transaksi <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>


            <!-- ROW 2 -->
            <div class="row">

                <!-- PRODUK TERLARIS -->
                <div class="col-lg-7 col-md-12">
                    <div class="card card-outline card-primary shadow-sm rounded">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title fw-bold mb-0">
                                <i class="fas fa-fire text-danger"></i> Produk Terlaris
                            </h3>
                        </div>

                        <div class="card-body p-0">
                            @if($produkTerlaris->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped table-sm mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Produk</th>
                                                <th class="text-center">Total Terjual</th>
                                                <th class="text-right">Total Pendapatan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($produkTerlaris as $p)
                                            <tr>
                                                <td class="fw-bold">{{ $p->namaproduk }}</td>
                                                <td class="text-center">
                                                    <span class="badge badge-primary px-3 py-1">
                                                        {{ $p->total_qty }}
                                                    </span>
                                                </td>
                                                <td class="text-right fw-bold text-success">
                                                    Rp {{ number_format($p->total_pendapatan) }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="p-4 text-center text-muted">
                                    <i class="fas fa-info-circle fa-2x mb-2"></i>
                                    <p class="mb-0">Belum ada transaksi hari ini.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>


                <!-- RINGKASAN -->
                <div class="col-lg-5 col-md-12">
                    <div class="card card-outline card-success shadow-sm rounded">

                        <div class="card-header">
                            <h3 class="card-title fw-bold mb-0">
                                <i class="fas fa-chart-line"></i> Ringkasan Bulan Ini
                            </h3>
                        </div>

                        <div class="card-body">

                            <div class="info-box shadow-sm">
                                <span class="info-box-icon bg-success elevation-1">
                                    <i class="fas fa-coins"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Pendapatan Bulan Ini</span>
                                    <span class="info-box-number text-success">
                                        Rp {{ number_format($pendapatanBulanIni) }}
                                    </span>
                                </div>
                            </div>

                            <div class="info-box shadow-sm">
                                <span class="info-box-icon bg-primary elevation-1">
                                    <i class="fas fa-chair"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Meja</span>
                                    <span class="info-box-number">
                                        {{ $totalMeja }}
                                    </span>
                                </div>
                            </div>

                            <div class="info-box shadow-sm mb-0">
                                <span class="info-box-icon bg-warning elevation-1">
                                    <i class="fas fa-users"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text">Total Kasir</span>
                                    <span class="info-box-number">
                                        {{ $totalKasir }}
                                    </span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>


            <!-- STOK MENIPIS -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-danger shadow-sm rounded">

                        <div class="card-header">
                            <h3 class="card-title fw-bold mb-0">
                                <i class="fas fa-exclamation-triangle"></i> Stok Menipis
                            </h3>
                        </div>

                        <div class="card-body p-0">
                            @if($stokMenipis->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped table-sm mb-0">
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Bahan Baku</th>
                                                <th class="text-center">Stok Tersedia</th>
                                                <th class="text-center">Stok Minimal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($stokMenipis as $s)
                                            <tr>
                                                <td class="fw-bold">{{ $s->namabahan }}</td>
                                                <td class="text-center text-danger fw-bold">
                                                    {{ $s->stoktersedia }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-danger px-3 py-1">
                                                        {{ $s->stokminimal }}
                                                    </span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="p-4 text-center text-muted">
                                    <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                                    <p class="mb-0">Semua stok masih aman.</p>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </section>

</div>
@endsection