@extends('layouts.apppelanggan')

@section('title', 'Pembayaran QRIS')

@section('content')
<div class="container py-5 text-center">

    <h4 class="fw-bold mb-3">Pembayaran QRIS</h4>

    <div class="card shadow-sm p-4 mx-auto" style="max-width:400px;">

        <h6>Invoice: {{ $pesanan->kodeinvoice }}</h6>

        <p class="text-muted">Scan QR untuk pembayaran</p>

        {{-- QR SIMULASI --}}
        <div class="border rounded p-3 mb-3">
            <h5 class="text-primary">{{ $qrisCode }}</h5>
        </div>

        <h4 class="text-success">
            Rp {{ number_format($pesanan->total,0,',','.') }}
        </h4>

        <hr>

        {{-- SIMULASI BAYAR --}}
        <form action="{{ route('pelanggan.qris.confirm', $pesanan->id) }}" method="POST">
            @csrf
            <button class="btn btn-success w-100">
                Saya Sudah Bayar
            </button>
        </form>

    </div>

</div>
@endsection