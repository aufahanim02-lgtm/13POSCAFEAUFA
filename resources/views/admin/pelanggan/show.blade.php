@extends('layouts.appadmin')

@section('title', 'Detail Pelanggan')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0 font-weight-bold">
            <i class="fas fa-user text-primary"></i> Detail Pelanggan
        </h3>

        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- PROFILE CARD --}}
    <div class="row">

        {{-- FOTO --}}
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">

                    @if($pelanggan->foto)
                        <img src="{{ asset('storage/' . $pelanggan->foto) }}"
                            class="img-thumbnail"
                            style="width:180px; height:180px; object-fit:cover; border-radius:50%;">
                    @else
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}"
                            class="img-thumbnail"
                            style="width:180px; height:180px; object-fit:cover; border-radius:50%;">
                    @endif

                    <h4 class="mt-3 font-weight-bold">
                        {{ $pelanggan->name }}
                    </h4>

                    <p class="text-muted mb-1">
                        <i class="fas fa-at"></i> {{ $pelanggan->username }}
                    </p>

                    <p class="text-muted mb-2">
                        <i class="fas fa-envelope"></i> {{ $pelanggan->email }}
                    </p>

                    <hr>

                    <p>
                        @if($pelanggan->status == 'blocked')
                            <span class="badge badge-danger px-3 py-2">
                                <i class="fas fa-ban"></i> BLOCKED
                            </span>
                        @else
                            <span class="badge badge-success px-3 py-2">
                                <i class="fas fa-check-circle"></i> AKTIF
                            </span>
                        @endif
                    </p>

                    <p>
                        <span class="badge badge-info px-3 py-2">
                            MEMBER: {{ strtoupper($pelanggan->levelmember) }}
                        </span>
                    </p>

                    <p>
                        <span class="badge badge-warning px-3 py-2">
                            POINT: {{ $pelanggan->point }}
                        </span>
                    </p>

                    <hr>

                    {{-- BUTTON BLOKIR / AKTIFKAN --}}
                    @if($pelanggan->status == 'blocked')
                        <form action="{{ route('admin.pelanggan.aktifkan', $pelanggan->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn btn-success btn-block"
                                onclick="return confirm('Aktifkan akun pelanggan ini?')">
                                <i class="fas fa-check"></i> Aktifkan Pelanggan
                            </button>
                        </form>
                    @else
                        <form action="{{ route('admin.pelanggan.blokir', $pelanggan->id) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="btn btn-warning btn-block"
                                onclick="return confirm('Blokir akun pelanggan ini?')">
                                <i class="fas fa-ban"></i> Blokir Pelanggan
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>

        {{-- INFO --}}
        <div class="col-md-8">

            <div class="card shadow-sm mb-3">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-id-card"></i> Informasi Akun
                    </h5>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <th style="width: 200px;">Nama</th>
                            <td>{{ $pelanggan->name }}</td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td>{{ $pelanggan->username }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $pelanggan->email }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $pelanggan->nohp ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($pelanggan->status == 'blocked')
                                    <span class="badge badge-danger px-3 py-2">
                                        BLOCKED
                                    </span>
                                @else
                                    <span class="badge badge-success px-3 py-2">
                                        AKTIF
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Level Member</th>
                            <td>{{ strtoupper($pelanggan->levelmember) }}</td>
                        </tr>
                        <tr>
                            <th>Point</th>
                            <td>{{ $pelanggan->point }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Daftar</th>
                            <td>{{ $pelanggan->created_at }}</td>
                        </tr>
                    </table>

                </div>
            </div>

            {{-- STAT TRANSAKSI --}}
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-receipt"></i> Statistik Transaksi
                    </h5>
                </div>

                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <div class="info-box bg-light shadow-sm">
                                <span class="info-box-icon bg-success">
                                    <i class="fas fa-shopping-cart"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text font-weight-bold">Total Transaksi</span>
                                    <span class="info-box-number">
                                        {{ $totalTransaksi ?? 0 }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-box bg-light shadow-sm">
                                <span class="info-box-icon bg-warning">
                                    <i class="fas fa-money-bill-wave"></i>
                                </span>

                                <div class="info-box-content">
                                    <span class="info-box-text font-weight-bold">Total Belanja</span>
                                    <span class="info-box-number">
                                        Rp {{ number_format($totalBelanja ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <small class="text-muted">
                        <i class="fas fa-info-circle"></i>
                        Data transaksi dihitung dari tabel penjualan pelanggan.
                    </small>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection