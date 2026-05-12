@extends('layouts.appkasir')

@section('title', 'Dashboard Kasir')

@section('content')

    {{-- HEADER --}}
    <section class="content-header pb-2">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div>
                    <h3 class="mb-1 fw-bold text-white">
                        <i class="fas fa-cash-register text-warning"></i> Dashboard Kasir
                    </h3>
                    <small class="text-muted">
                        Selamat datang kembali, <b class="text-white">{{ Auth::user()->name ?? 'Kasir' }}</b> 👋
                    </small>
                </div>

                <div class="mt-2 mt-sm-0 d-flex gap-2 flex-wrap">
                    <span class="badge badge-success px-3 py-2 shadow-sm">
                        <i class="fas fa-user-shield"></i> {{ strtoupper(Auth::user()->role ?? '-') }}
                    </span>

                    <span class="badge badge-info px-3 py-2 shadow-sm">
                        <i class="fas fa-calendar-alt"></i> {{ date('d M Y') }}
                    </span>

                    <span class="badge badge-dark px-3 py-2 shadow-sm">
                        <i class="fas fa-clock"></i> {{ date('H:i') }} WIB
                    </span>
                </div>

            </div>
        </div>
    </section>


    {{-- CONTENT --}}
    <section class="content">
        <div class="container-fluid">

            {{-- ALERT --}}
            @if(session('success'))
                <div class="alert alert-success shadow-sm">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger shadow-sm">
                    <i class="fas fa-times-circle"></i> {{ session('error') }}
                </div>
            @endif


            {{-- MENU BOX --}}
            <div class="row g-3">

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="small-box bg-primary shadow-sm rounded-lg">
                        <div class="inner">
                            <h3 class="fw-bold mb-1">POS</h3>
                            <p class="mb-0">Mulai transaksi baru</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-cash-register"></i>
                        </div>
                        <a href="{{ route('kasir.pos') }}" class="small-box-footer">
                            Buka POS <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="small-box bg-warning shadow-sm rounded-lg">
                        <div class="inner text-dark">
                            <h3 class="fw-bold mb-1">Bayar</h3>
                            <p class="mb-0">Kelola pembayaran</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <a href="{{ route('kasir.pembayaran.index') }}" class="small-box-footer text-dark">
                            Pembayaran <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 col-12">
                    <div class="small-box bg-success shadow-sm rounded-lg">
                        <div class="inner">
                            <h3 class="fw-bold mb-1">Shift</h3>
                            <p class="mb-0">Kelola shift kasir</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-clock"></i>
                        </div>
                        <a href="{{ route('kasir.shift.index') }}" class="small-box-footer">
                            Kelola Shift <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

            </div>


            {{-- INFO + PROFIL --}}
            <div class="row mt-3 g-3">

                {{-- INFORMASI SISTEM --}}
                <div class="col-lg-8 col-md-12">
                    <div class="card shadow-sm border-0 rounded-lg h-100">

                        <div class="card-header bg-transparent border-0 pb-0">
                            <h5 class="fw-bold mb-0 text-white">
                                <i class="fas fa-info-circle text-warning"></i> Informasi Sistem
                            </h5>
                        </div>

                        <div class="card-body pt-3">

                            <p class="text-muted mb-4">
                                CAFEPOS membantu kasir melakukan transaksi lebih cepat, aman, dan rapi.
                                Semua transaksi akan otomatis tersimpan untuk laporan Owner/Manager.
                            </p>

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <div class="p-3 rounded-lg shadow-sm bg-light">
                                        <h6 class="fw-bold mb-1">
                                            <i class="fas fa-bolt text-warning"></i> Transaksi Cepat
                                        </h6>
                                        <small class="text-muted">
                                            Input produk dan hitung otomatis realtime.
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="p-3 rounded-lg shadow-sm bg-light">
                                        <h6 class="fw-bold mb-1">
                                            <i class="fas fa-lock text-success"></i> Aman & Terproteksi
                                        </h6>
                                        <small class="text-muted">
                                            Hak akses role berbeda sesuai user.
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="p-3 rounded-lg shadow-sm bg-light">
                                        <h6 class="fw-bold mb-1">
                                            <i class="fas fa-receipt text-primary"></i> Cetak Struk Otomatis
                                        </h6>
                                        <small class="text-muted">
                                            Struk langsung tersedia setelah transaksi sukses.
                                        </small>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <div class="p-3 rounded-lg shadow-sm bg-light">
                                        <h6 class="fw-bold mb-1">
                                            <i class="fas fa-chart-line text-danger"></i> Data Tersimpan
                                        </h6>
                                        <small class="text-muted">
                                            Semua transaksi otomatis masuk laporan.
                                        </small>
                                    </div>
                                </div>

                            </div>

                            <hr>

                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('kasir.pos') }}" class="btn btn-primary btn-sm px-4 rounded-pill">
                                    <i class="fas fa-cash-register"></i> Mulai POS
                                </a>

                                <a href="{{ route('kasir.pembayaran.index') }}" class="btn btn-warning btn-sm px-4 rounded-pill text-white">
                                    <i class="fas fa-money-bill-wave"></i> Pembayaran
                                </a>

                                <a href="{{ route('kasir.shift.index') }}" class="btn btn-success btn-sm px-4 rounded-pill">
                                    <i class="fas fa-user-clock"></i> Shift
                                </a>
                            </div>

                        </div>
                    </div>
                </div>


                {{-- PROFIL KASIR --}}
                <div class="col-lg-4 col-md-12">
                    <div class="card shadow-sm border-0 rounded-lg h-100">

                        <div class="card-header bg-transparent border-0 pb-0">
                            <h5 class="fw-bold mb-0 text-white">
                                <i class="fas fa-user text-warning"></i> Profil Kasir
                            </h5>
                        </div>

                        <div class="card-body text-center pt-3">

                            @if(Auth::user()->foto)
                                <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                                    class="shadow-sm mb-3"
                                    style="width:110px; height:110px; object-fit:cover; border-radius:12px;"
                                    alt="Foto Kasir">
                            @else
                                <img src="{{ asset('dist/img/user2-160x160.jpg') }}"
                                    class="shadow-sm mb-3"
                                    style="width:110px; height:110px; object-fit:cover; border-radius:12px;"
                                    alt="Foto Kasir">
                            @endif

                            <h5 class="fw-bold mb-1 text-white">
                                {{ Auth::user()->name ?? 'Kasir' }}
                            </h5>

                            <small class="text-muted d-block mb-2">
                                <i class="fas fa-user"></i> {{ Auth::user()->username ?? '-' }}
                            </small>

                            <span class="badge badge-success px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-circle"></i> Online
                            </span>

                            <hr>

                            <div class="text-muted">
                                <small>Login Hari Ini</small>
                                <h6 class="fw-bold mt-2 mb-0 text-warning">
                                    {{ date('H:i') }} WIB
                                </h6>
                            </div>

                        </div>
                    </div>
                </div>

            </div>


            {{-- QUICK ACTION --}}
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card shadow-sm border-0 rounded-lg">

                        <div class="card-header bg-transparent border-0 pb-0">
                            <h5 class="fw-bold mb-0 text-white">
                                <i class="fas fa-bolt text-warning"></i> Quick Action
                            </h5>
                        </div>

                        <div class="card-body pt-3">
                            <div class="row text-center g-2">

                                <div class="col-md-4 col-12">
                                    <a href="{{ route('kasir.pos') }}" class="btn btn-primary btn-lg btn-block rounded-pill shadow-sm">
                                        <i class="fas fa-cash-register"></i> POS
                                    </a>
                                </div>

                                <div class="col-md-4 col-12">
                                    <a href="{{ route('kasir.pembayaran.index') }}" class="btn btn-warning btn-lg btn-block rounded-pill shadow-sm text-white">
                                        <i class="fas fa-money-bill-wave"></i> Pembayaran
                                    </a>
                                </div>

                                <div class="col-md-4 col-12">
                                    <a href="{{ route('kasir.shift.index') }}" class="btn btn-success btn-lg btn-block rounded-pill shadow-sm">
                                        <i class="fas fa-user-clock"></i> Shift
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection