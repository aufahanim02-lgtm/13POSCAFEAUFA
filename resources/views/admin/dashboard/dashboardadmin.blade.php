@extends('layouts.appadmin')

@section('title', 'Dashboard Owner')

@section('content')

    {{-- HEADER --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-3 align-items-center">

                <div class="col-sm-6">
                    <h1 class="fw-bold mb-0">
                        Dashboard Owner
                    </h1>
                    <small class="text-muted">
                        Selamat datang kembali, <b>{{ Auth::user()->name ?? 'Owner' }}</b> 👋
                    </small>
                </div>

                <div class="col-sm-6 text-right mt-2 mt-sm-0">
                    <span class="badge badge-light p-2 shadow-sm">
                        <i class="fas fa-calendar-alt"></i>
                        {{ now()->format('d M Y') }}
                    </span>
                </div>

            </div>
        </div>
    </section>


    {{-- MAIN CONTENT --}}
    <section class="content">
        <div class="container-fluid">

            {{-- STAT BOX --}}
            <div class="row">

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info shadow-sm">
                        <div class="inner">
                            <h3 class="mb-0">{{ $totalProduk ?? 0 }}</h3>
                            <p class="mb-0">Total Produk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <a href="{{ route('master.produk.index') }}" class="small-box-footer">
                            Kelola Produk <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success shadow-sm">
                        <div class="inner">
                            <h3 class="mb-0">{{ $totalKategori ?? 0 }}</h3>
                            <p class="mb-0">Total Kategori</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <a href="{{ route('master.kategori.index') }}" class="small-box-footer">
                            Kelola Kategori <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning shadow-sm">
                        <div class="inner">
                            <h3 class="mb-0">{{ $totalMeja ?? 0 }}</h3>
                            <p class="mb-0">Total Meja</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chair"></i>
                        </div>
                        <a href="{{ route('master.meja.index') }}" class="small-box-footer">
                            Kelola Meja <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger shadow-sm">
                        <div class="inner">
                            <h3 class="mb-0">{{ $totalUser ?? 0 }}</h3>
                            <p class="mb-0">Total User</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('master.user.index') }}" class="small-box-footer">
                            Kelola User <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>


            {{-- RINGKASAN + SHIFT --}}
            <div class="row">

                {{-- RINGKASAN PENJUALAN --}}
                <div class="col-md-6">
                    <div class="card card-outline card-primary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title fw-bold mb-0">
                                <i class="fas fa-chart-line mr-1"></i>
                                Ringkasan Penjualan Hari Ini
                            </h3>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped mb-0">
                                <tbody>
                                    <tr>
                                        <th style="width: 60%">Total Transaksi</th>
                                        <td class="text-right fw-bold">
                                            {{ $transaksiHariIni ?? 0 }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Total Pendapatan</th>
                                        <td class="text-right text-success fw-bold">
                                            Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Total Diskon</th>
                                        <td class="text-right text-warning fw-bold">
                                            Rp {{ number_format($diskonHariIni ?? 0, 0, ',', '.') }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Total Pajak</th>
                                        <td class="text-right text-info fw-bold">
                                            Rp {{ number_format($pajakHariIni ?? 0, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer text-muted text-sm">
                            Data otomatis dihitung berdasarkan transaksi hari ini.
                        </div>
                    </div>
                </div>


                {{-- SHIFT AKTIF --}}
                <div class="col-md-6">
                    <div class="card card-outline card-success shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title fw-bold mb-0">
                                <i class="fas fa-user-clock mr-1"></i>
                                Shift Aktif
                            </h3>
                        </div>

                        <div class="card-body">
                            @if(isset($shiftAktif) && $shiftAktif)

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Kasir</span>
                                    <span class="fw-bold">{{ $shiftAktif->user->name ?? '-' }}</span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Mulai</span>
                                    <span class="fw-bold">{{ $shiftAktif->shiftmulai ?? '-' }}</span>
                                </div>

                                <div class="d-flex justify-content-between mb-3">
                                    <span class="text-muted">Saldo Awal</span>
                                    <span class="fw-bold text-success">
                                        Rp {{ number_format($shiftAktif->saldoawal ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>

                                <span class="badge badge-success px-3 py-2">
                                    <i class="fas fa-check-circle"></i> SHIFT OPEN
                                </span>

                            @else
                                <div class="text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Tidak ada shift aktif saat ini.
                                </div>
                            @endif
                        </div>

                        <div class="card-footer text-muted text-sm">
                            Shift hanya aktif jika kasir membuka shift.
                        </div>
                    </div>
                </div>

            </div>


            {{-- LAPORAN TERBARU --}}
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-primary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title fw-bold mb-0">
                                <i class="fas fa-file-alt mr-1"></i>
                                5 Laporan Terbaru
                            </h3>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th style="width: 5%">#</th>
                                            <th style="width: 20%">Jenis</th>
                                            <th style="width: 30%">Tanggal</th>
                                            <th style="width: 25%">Total</th>
                                            <th style="width: 20%" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @if(isset($laporanTerbaru) && count($laporanTerbaru) > 0)
                                            @foreach($laporanTerbaru as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>

                                                    <td>
                                                        <span class="badge badge-info px-2 py-1">
                                                            {{ $item['jenis'] }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <i class="fas fa-calendar text-muted"></i>
                                                        {{ $item['tanggal'] }}
                                                    </td>

                                                    <td class="fw-bold text-success">
                                                        Rp {{ number_format($item['total'] ?? 0, 0, ',', '.') }}
                                                    </td>

                                                    <td class="text-center">
                                                        <a href="{{ $item['route'] }}" class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-eye"></i> Detail
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" class="text-center text-muted py-4">
                                                    <i class="fas fa-folder-open"></i>
                                                    Belum ada laporan terbaru.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('laporan.index') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-folder"></i> Lihat Semua Laporan
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            {{-- QUICK ACCESS --}}
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-secondary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title fw-bold mb-0">
                                <i class="fas fa-link mr-1"></i>
                                Quick Access
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row text-center">

                                <div class="col-md-2 col-6 mb-3">
                                    <a href="{{ route('master.produk.index') }}" class="btn btn-info btn-block shadow-sm">
                                        <i class="fas fa-box fa-lg mb-1"></i><br>
                                        <span class="text-sm fw-bold">Produk</span>
                                    </a>
                                </div>

                                <div class="col-md-2 col-6 mb-3">
                                    <a href="{{ route('master.kategori.index') }}" class="btn btn-success btn-block shadow-sm">
                                        <i class="fas fa-list fa-lg mb-1"></i><br>
                                        <span class="text-sm fw-bold">Kategori</span>
                                    </a>
                                </div>

                                <div class="col-md-2 col-6 mb-3">
                                    <a href="{{ route('master.meja.index') }}" class="btn btn-warning btn-block shadow-sm">
                                        <i class="fas fa-chair fa-lg mb-1"></i><br>
                                        <span class="text-sm fw-bold">Meja</span>
                                    </a>
                                </div>

                                <div class="col-md-2 col-6 mb-3">
                                    <a href="{{ route('master.user.index') }}" class="btn btn-danger btn-block shadow-sm">
                                        <i class="fas fa-users fa-lg mb-1"></i><br>
                                        <span class="text-sm fw-bold">User</span>
                                    </a>
                                </div>

                                <div class="col-md-2 col-6 mb-3">
                                    <a href="{{ route('laporan.index') }}" class="btn btn-primary btn-block shadow-sm">
                                        <i class="fas fa-file-alt fa-lg mb-1"></i><br>
                                        <span class="text-sm fw-bold">Laporan</span>
                                    </a>
                                </div>

                                <div class="col-md-2 col-6 mb-3">
                                    <a href="{{ route('loginhistory.index') }}" class="btn btn-secondary btn-block shadow-sm">
                                        <i class="fas fa-history fa-lg mb-1"></i><br>
                                        <span class="text-sm fw-bold">History</span>
                                    </a>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer text-muted text-sm">
                            Shortcut menu untuk akses cepat fitur utama.
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

</div>
@endsection