@extends('layouts.apppelanggan')

@section('title', 'Pembayaran QRIS')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body text-center">

            <h4 class="fw-bold mb-1">Pembayaran QRIS</h4>
            <p class="text-muted mb-3">Silakan scan QR Code berikut untuk membayar pesanan.</p>

            <div class="mb-2">
                <span class="badge bg-dark px-3 py-2">
                    Invoice: {{ $data->kodeinvoice }}
                </span>
            </div>

            <div class="mb-4">
                <h4 class="fw-bold text-success">
                    Rp {{ number_format($data->total, 0, ',', '.') }}
                </h4>
            </div>

            {{-- QRIS IMAGE (PAKAI FIELD qris_reference UNTUK VALIDASI) --}}
            <div class="mb-4">
                <div class="alert alert-info">
                    Silakan scan QRIS menggunakan aplikasi pembayaran Anda.
                </div>

                {{-- Jika kamu punya QRIS image statis di public --}}
                <img src="{{ asset('foto/qris/qris.png') }}"
                     class="img-fluid border rounded-4 p-2"
                     style="max-width:250px;"
                     alt="QRIS">
            </div>

            <p class="small text-muted">
                Reference: <b>{{ $data->qris_reference }}</b>
            </p>

            {{-- FIX ROUTE NAME --}}
            <form action="{{ route('pelanggan.pesanan.qris.konfirmasi', $data->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success px-4">
                    Saya Sudah Bayar
                </button>
            </form>

            <div class="mt-3">
                <a href="{{ route('pelanggan.pesanan.detail', $data->id) }}"
                   class="btn btn-outline-secondary">
                    Kembali ke Detail Pesanan
                </a>
            </div>

        </div>
    </div>

</div>
@endsection