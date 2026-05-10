@extends('layouts.appkasir')

@section('title', 'Detail Riwayat Transaksi')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1 class="fw-bold">Detail Transaksi</h1>
            <small class="text-muted">Informasi lengkap transaksi kasir</small>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">
                        <i class="fas fa-receipt"></i> Detail Invoice
                    </h3>
                </div>

                <div class="card-body">

                    {{-- INFO PENJUALAN --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="mb-1"><b>Kode Invoice:</b> {{ $penjualan->kodeinvoice }}</p>
                            <p class="mb-1"><b>Tanggal:</b>
                                {{ $penjualan->tanggalpenjualan ? date('d-m-Y H:i', strtotime($penjualan->tanggalpenjualan)) : '-' }}
                            </p>
                            <p class="mb-1"><b>Status:</b>
                                @if($penjualan->status == 'paid')
                                <span class="badge badge-success px-3 py-2">PAID</span>
                                @else
                                <span class="badge badge-warning px-3 py-2">PENDING</span>
                                @endif
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p class="mb-1"><b>Subtotal:</b> Rp {{ number_format($penjualan->subtotal, 0, ',', '.') }}</p>
                            <p class="mb-1"><b>Diskon:</b> Rp {{ number_format($penjualan->diskon, 0, ',', '.') }}</p>
                            <p class="mb-1"><b>Pajak:</b> Rp {{ number_format($penjualan->pajak, 0, ',', '.') }}</p>
                            <hr class="my-2">
                            <p class="mb-1 text-success fw-bold">
                                <b>Total:</b> Rp {{ number_format($penjualan->total, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>

                    <hr>

                    {{-- DETAIL PRODUK --}}
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-box"></i> Detail Produk
                    </h5>

                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="bg-dark text-white">
                                <tr class="text-center">
                                    <th style="width:50px;">No</th>
                                    <th>Nama Produk</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($detail as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        {{ $item->produk->namaproduk ?? 'Produk tidak ditemukan' }}
                                    </td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">
                                        Tidak ada detail produk.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PEMBAYARAN --}}
                    <h5 class="fw-bold mb-3">
                        <i class="fas fa-money-bill-wave"></i> Informasi Pembayaran
                    </h5>

                    <div class="alert alert-light border">
                        <p class="mb-1">
                            <b>Metode:</b> {{ $pembayaran->metode->namametode ?? '-' }}
                        </p>

                        <p class="mb-1">
                            <b>Jumlah Bayar:</b>
                            Rp {{ number_format($pembayaran->jumlahbayar ?? 0, 0, ',', '.') }}
                        </p>

                        <p class="mb-1">
                            <b>Kembalian:</b>
                            Rp {{ number_format($pembayaran->kembalian ?? 0, 0, ',', '.') }}
                        </p>

                        <p class="mb-0">
                            <b>Tanggal Bayar:</b>
                            {{ $pembayaran->tanggalbayar ? date('d-m-Y H:i', strtotime($pembayaran->tanggalbayar)) : '-' }}
                        </p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('kasir.riwayat.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>

                        <a href="{{ route('kasir.cetakstruk.print', $penjualan->id) }}" class="btn btn-success">
                            <i class="fas fa-print"></i> Cetak Struk
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>
@endsection