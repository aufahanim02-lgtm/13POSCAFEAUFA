@extends('layouts.apppelanggan')

@section('title', 'Checkout')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Checkout Pesanan</h4>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4 mb-3">
        <div class="card-body">

            <form action="{{ route('pelanggan.checkout.proses') }}" method="POST">
                @csrf

                {{-- PILIH MEJA --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Meja</label>
                    <select name="mejaid" class="form-control" required>
                        <option value="">-- Pilih Meja --</option>
                        @foreach($meja as $m)
                            <option value="{{ $m->id }}">
                                Meja {{ $m->nomormeja }} ({{ $m->status }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- METODE BAYAR --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Metode Pembayaran</label>
                    <select name="metodebayar" class="form-control" required>
                        <option value="kasir">Bayar di Kasir</option>
                        <option value="qris">Bayar QRIS (Langsung)</option>
                    </select>
                </div>

                <hr>

                <h6 class="fw-bold mb-2">Item Pesanan</h6>

                <ul class="list-group mb-3">
                    @foreach($keranjang as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <b>{{ $item->produk->namaproduk ?? '-' }}</b>
                                <br>
                                <small class="text-muted">Qty: {{ $item->qty }}</small>
                            </div>
                            <div class="fw-bold">
                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>
                        </li>
                    @endforeach
                </ul>

                {{-- ===================== --}}
                {{-- RINCIAN PERHITUNGAN --}}
                {{-- ===================== --}}

                <div class="border rounded-3 p-3 mb-3 bg-light">

                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <b>Rp {{ number_format($subtotal, 0, ',', '.') }}</b>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Diskon Promo</span>
                        <b class="text-danger">
                            - Rp {{ number_format($diskon ?? 0, 0, ',', '.') }}
                        </b>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Pajak</span>
                        <b>
                            + Rp {{ number_format($pajak ?? 0, 0, ',', '.') }}
                        </b>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fs-5">
                        <span class="fw-bold">Total Bayar</span>
                        <span class="fw-bold text-success">
                            Rp {{ number_format($total ?? $subtotal, 0, ',', '.') }}
                        </span>
                    </div>

                </div>

                {{-- INFO PROMO --}}
                @if(isset($promoAktif))
                    <div class="alert alert-info py-2">
                        Promo aktif: <b>{{ $promoAktif->namapromo ?? 'Promo Aktif' }}</b>
                    </div>
                @endif

                {{-- INFO PAJAK --}}
                @if(isset($pajakAktif))
                    <div class="alert alert-warning py-2">
                        Pajak aktif: <b>{{ $pajakAktif->namapajak ?? 'Pajak Aktif' }}</b>
                    </div>
                @endif

                <button class="btn btn-success w-100 mt-3">
                    Buat Pesanan
                </button>

            </form>

        </div>
    </div>

</div>
@endsection