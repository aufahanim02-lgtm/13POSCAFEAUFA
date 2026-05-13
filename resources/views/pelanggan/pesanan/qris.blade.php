@extends('layouts.apppelanggan')

@section('title', 'Pembayaran QRIS')

@section('content')

<div class="container py-4">

    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body text-center p-4">

                    {{-- TITLE --}}
                    <h3 class="fw-bold mb-2">
                        Pembayaran QRIS
                    </h3>

                    <p class="text-muted mb-4">
                        Silakan scan QR Code berikut menggunakan aplikasi pembayaran Anda.
                    </p>

                    {{-- INVOICE --}}
                    <div class="mb-3">

                        <span class="badge bg-dark px-3 py-2 fs-6">

                            Invoice :
                            {{ $data->kodeinvoice }}

                        </span>

                    </div>

                    {{-- TOTAL --}}
                    <div class="mb-4">

                        <div class="text-muted small">
                            Total Pembayaran
                        </div>

                        <h2 class="fw-bold text-success">

                            Rp {{ number_format($data->total, 0, ',', '.') }}

                        </h2>

                    </div>

                    {{-- ALERT --}}
                    <div class="alert alert-info border-0 rounded-3">

                        Scan QR Code di bawah ini untuk melakukan pembayaran.

                    </div>
                    {{-- QR IMAGE --}}
                    <div class="mb-4">

                        @if($data->qris_image)

                        <img
                            src="{{ asset('storage/' . $data->qris_image) }}"
                            class="img-fluid border rounded-4 shadow-sm p-2 bg-white"
                            style="max-width:260px;"
                            alt="QRIS">

                        @else

                        <div class="alert alert-danger rounded-3">
                            QR Code tidak tersedia
                        </div>

                        @endif

                    </div>

                    {{-- REFERENCE --}}
                    <div class="mb-4">

                        <div class="small text-muted">
                            Reference QRIS
                        </div>

                        <div class="fw-semibold">

                            {{ $data->qris_reference ?? '-' }}

                        </div>

                    </div>

                    {{-- STATUS --}}
                    <div class="mb-4">

                        @if($data->statuspembayaran == 'lunas')

                        <span class="badge bg-success px-3 py-2">
                            Pembayaran Lunas
                        </span>

                        @else

                        <span class="badge bg-warning text-dark px-3 py-2">
                            Menunggu Pembayaran
                        </span>

                        @endif

                    </div>

                    {{-- BUTTON KONFIRMASI --}}
                    <form
                        action="{{ route('pelanggan.pesanan.qris.konfirmasi', $data->id) }}"
                        method="POST">

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-success px-4 py-2 rounded-3">

                            <i class="fa-solid fa-check me-2"></i>
                            Saya Sudah Bayar

                        </button>

                    </form>

                    {{-- BACK BUTTON --}}
                    <div class="mt-3">

                        <a
                            href="{{ route('pelanggan.pesanan.detail', $data->id) }}"
                            class="btn btn-outline-secondary rounded-3">

                            <i class="fa-solid fa-arrow-left me-2"></i>
                            Kembali ke Detail Pesanan

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection