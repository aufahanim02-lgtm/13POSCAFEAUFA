@extends('layouts.appkasir')

@section('title', 'QRIS Pembayaran')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-lg-6">

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <div class="card shadow border-0 rounded-4">

                <div class="card-header bg-dark text-white text-center">
                    <h4 class="mb-0">
                        <i class="fas fa-qrcode"></i>
                        Pembayaran QRIS
                    </h4>
                </div>

                <div class="card-body text-center">

                    <h5 class="fw-bold text-primary">
                        {{ $pesanan->kodeinvoice }}
                    </h5>

                    <p class="mb-1">
                        Pelanggan:
                        <b>{{ $pesanan->pelanggan->name ?? '-' }}</b>
                    </p>

                    <p class="mb-3">
                        Total Bayar:
                    </p>

                    <h2 class="fw-bold text-success mb-4">
                        Rp {{ number_format($pesanan->total, 0, ',', '.') }}
                    </h2>

                    {{-- QRIS IMAGE --}}
                    <img
                        src="https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=QRIS-{{ $pesanan->kodeinvoice }}"
                        class="img-fluid border rounded-4 shadow-sm p-2 bg-white"
                        style="max-width:260px;"
                        alt="QRIS">

                    <p class="text-muted">
                        Silakan scan QRIS menggunakan E-Wallet / Mobile Banking
                    </p>

                    <form
                        action="{{ route('kasir.pembayaranpelanggan.qris.konfirmasi', $pesanan->id) }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-success btn-lg w-100">

                            <i class="fas fa-check-circle"></i>
                            Konfirmasi Pembayaran
                        </button>

                    </form>

                    <a
                        href="{{ route('kasir.pembayaranpelanggan.index') }}"
                        class="btn btn-secondary mt-3 w-100">

                        <i class="fas fa-arrow-left"></i>
                        Kembali
                    </a>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection