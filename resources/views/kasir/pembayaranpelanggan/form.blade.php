@extends('layouts.appkasir')


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

                    <h5 class="fw-bold mb-4 text-dark">
                        Info Pesanan
                    </h5>

                    <div class="mb-2">
                        <small class="text-muted">Invoice</small>
                        <div class="fw-semibold text-dark">
                            {{ $pesanan->kodeinvoice }}
                        </div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">Pelanggan</small>
                        <div class="fw-semibold text-dark">
                            {{ $pesanan->pelanggan->name ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">Meja</small>
                        <div class="fw-semibold text-dark">
                            {{ $pesanan->meja->nomormeja ?? '-' }}
                        </div>
                    </div>

                    <div class="mb-2">
                        <small class="text-muted">Status Pesanan</small>
                        <div class="fw-semibold text-dark">
                            {{ strtoupper($pesanan->statuspesanan) }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">Status Pembayaran</small>
                        <div>
                            @if($pesanan->statuspembayaran == 'belumbayar')
                            <span class="badge bg-danger px-3 py-2">
                                BELUM BAYAR
                            </span>
                            @else
                            <span class="badge bg-success px-3 py-2">
                                LUNAS
                            </span>
                            @endif
                        </div>
                    </div>

                    <hr class="my-4">

                    <h6 class="fw-bold mb-3 text-dark">
                        Detail Item Pesanan
                    </h6>

                    @foreach($pesanan->detail as $d)
                    <div class="mb-3 p-3 rounded-3 border bg-light">

                        <div class="d-flex justify-content-between align-items-start">

                            <div>
                                <div class="fw-semibold text-dark">
                                    {{ $d->produk->namaproduk ?? '-' }}
                                </div>

                                <small class="text-muted">
                                    Qty {{ $d->qty }} × Rp {{ number_format($d->harga,0,',','.') }}
                                </small>
                            </div>

                            <div class="fw-bold text-dark">
                                Rp {{ number_format($d->subtotal,0,',','.') }}
                            </div>

                        </div>

                    </div>
                    @endforeach

                    <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                        <span class="fw-bold text-dark">
                            TOTAL
                        </span>
                        <span class="fw-bold text-dark fs-5">
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