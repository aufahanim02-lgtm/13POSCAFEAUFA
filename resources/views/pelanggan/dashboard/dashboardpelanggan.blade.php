@extends('layouts.apppelanggan')

@section('title', 'Dashboard Pelanggan')

@section('content')

<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Dashboard Pelanggan</h3>
            <p class="text-muted mb-0">
                Selamat datang, <b>{{ $pelanggan->name ?? 'Pelanggan' }}</b>
            </p>
        </div>

        <a href="{{ url('/pelanggan/menu') }}" class="btn btn-primary shadow-sm">
            🛒 Pesan Sekarang
        </a>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">Total Pesanan</small>
                    <h3 class="fw-bold mb-0">{{ $totalPesanan }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">Pesanan Aktif</small>
                    <h3 class="fw-bold text-warning mb-0">{{ $pesananAktif }}</h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">Point Member</small>
                    <h3 class="fw-bold text-success mb-0">
                        {{ $pelanggan->point ?? 0 }}
                    </h3>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body">
                    <small class="text-muted">Promo Aktif</small>
                    <h3 class="fw-bold text-primary mb-0">{{ $promoAktif }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- RIWAYAT --}}
    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold">Riwayat Pesanan</h5>
            <a href="{{ url('/pelanggan/pesanan') }}" class="btn btn-sm btn-outline-primary">
                Lihat Semua
            </a>
        </div>

        <div class="card-body">

            @if($riwayat->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead class="table-light">
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
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @elseif($row->statuspesanan == 'diproses')
                                        <span class="badge bg-info">Diproses</span>
                                    @elseif($row->statuspesanan == 'siapdiambil')
                                        <span class="badge bg-primary">Siap</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>

                                <td>
                                    @if($row->statuspembayaran == 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-danger">Belum Bayar</span>
                                    @endif
                                </td>

                                <td>
                                    Rp {{ number_format($row->total, 0, ',', '.') }}
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
                         width="100" class="mb-3">

                    <h6 class="fw-bold">Belum ada pesanan</h6>
                    <p class="text-muted">Yuk mulai pesan menu favorit kamu</p>

                    <a href="{{ url('/pelanggan/menu') }}" class="btn btn-primary">
                        Mulai Pesan
                    </a>
                </div>

            @endif

        </div>
    </div>

</div>

@endsection