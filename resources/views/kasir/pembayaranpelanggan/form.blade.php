@extends('layouts.appkasir')

@section('title', 'Form Pembayaran Pelanggan')

@section('content')
<div class="container-fluid py-4">

    <h4 class="fw-bold mb-3">Form Pembayaran Pesanan Pelanggan</h4>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- JIKA PESANAN QRIS --}}
    @if($pesanan->payment_gateway == 'qris')

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body text-center py-5">

                <h3 class="fw-bold text-primary mb-3">
                    Pembayaran Menggunakan QRIS
                </h3>

                <p class="text-muted mb-4">
                    Pelanggan harus menyelesaikan pembayaran melalui halaman QRIS.
                </p>

                <a href="{{ route('pelanggan.pesanan.qris.page', $pesanan->id) }}"
                   class="btn btn-primary btn-lg">
                    <i class="fas fa-qrcode"></i>
                    Buka Halaman QRIS
                </a>

                <a href="{{ route('kasir.pembayaranpelanggan.index') }}"
                   class="btn btn-secondary btn-lg ms-2">
                    Kembali
                </a>

            </div>
        </div>

    @else

    <div class="row">

        {{-- INFO PESANAN --}}
        <div class="col-md-5">
            <div class="card shadow-sm border-0 rounded-4 mb-3">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">Info Pesanan</h5>

                    <p class="mb-1">
                        <b>Invoice:</b>
                        {{ $pesanan->kodeinvoice }}
                    </p>

                    <p class="mb-1">
                        <b>Pelanggan:</b>
                        {{ $pesanan->pelanggan->name ?? '-' }}
                    </p>

                    <p class="mb-1">
                        <b>Meja:</b>
                        {{ $pesanan->meja->nomormeja ?? '-' }}
                    </p>

                    <p class="mb-1">
                        <b>Status Pesanan:</b>
                        {{ strtoupper($pesanan->statuspesanan) }}
                    </p>

                    <p class="mb-3">
                        <b>Status Bayar:</b>

                        @if($pesanan->statuspembayaran == 'belumbayar')
                            <span class="badge bg-danger">
                                BELUM BAYAR
                            </span>
                        @else
                            <span class="badge bg-success">
                                LUNAS
                            </span>
                        @endif
                    </p>

                    <hr>

                    <h6 class="fw-bold mb-2">
                        Detail Item
                    </h6>

                    <ul class="list-group">

                        @foreach($pesanan->detail as $d)

                            <li class="list-group-item d-flex justify-content-between align-items-center">

                                <div>
                                    <b>
                                        {{ $d->produk->namaproduk ?? '-' }}
                                    </b>

                                    <br>

                                    <small class="text-muted">
                                        Qty: {{ $d->qty }}
                                        x
                                        Rp {{ number_format($d->harga,0,',','.') }}
                                    </small>
                                </div>

                                <div class="fw-bold text-success">
                                    Rp {{ number_format($d->subtotal,0,',','.') }}
                                </div>

                            </li>

                        @endforeach

                    </ul>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">
                            TOTAL
                        </span>

                        <span class="fw-bold text-primary">
                            Rp {{ number_format($pesanan->total,0,',','.') }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

        {{-- FORM PEMBAYARAN --}}
        <div class="col-md-7">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body">

                    <h5 class="fw-bold mb-3">
                        Input Pembayaran
                    </h5>

                    <form action="{{ route('kasir.pembayaranpelanggan.proses', $pesanan->id) }}"
                          method="POST">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Metode Pembayaran
                            </label>

                            <select name="metodepembayaranid"
                                    class="form-control"
                                    required>

                                <option value="">
                                    -- Pilih Metode Pembayaran --
                                </option>

                                @foreach($metode as $m)

                                    <option value="{{ $m->id }}">
                                        {{ strtoupper($m->namametode) }}
                                        ({{ strtoupper($m->jenis) }})
                                    </option>

                                @endforeach

                            </select>
                        </div>

                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Jumlah Bayar
                            </label>

                            <input type="number"
                                   name="jumlahbayar"
                                   class="form-control"
                                   placeholder="Masukkan uang pembayaran"
                                   required>

                        </div>

                        <button type="submit"
                                class="btn btn-success w-100">

                            <i class="fas fa-check"></i>
                            Proses Pembayaran

                        </button>

                        <a href="{{ route('kasir.pembayaranpelanggan.index') }}"
                           class="btn btn-secondary w-100 mt-2">

                            <i class="fas fa-arrow-left"></i>
                            Kembali

                        </a>

                    </form>

                </div>
            </div>
        </div>

    </div>

    @endif

</div>
@endsection