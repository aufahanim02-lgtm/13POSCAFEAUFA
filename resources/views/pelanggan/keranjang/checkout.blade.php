@extends('layouts.apppelanggan')

@section('title', 'Checkout')

@section('content')
<div class="container py-4">

    <a href="{{ url('/pelanggan/keranjang') }}" class="btn btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white border-0 rounded-top-4">
            <h4 class="fw-bold mb-0">Checkout</h4>
        </div>
        <div class="card-body p-4">

            <h6 class="fw-bold mb-3">Ringkasan Pesanan</h6>

            @php $total = 0; @endphp

            <ul class="list-group mb-4">
                @foreach($keranjang as $row)
                    @php $total += $row->subtotal; @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <b>{{ $row->produk->namaproduk ?? '-' }}</b>
                            <div class="text-muted small">Qty: {{ $row->qty }}</div>
                        </div>
                        <span>Rp {{ number_format($row->subtotal ?? 0, 0, ',', '.') }}</span>
                    </li>
                @endforeach
            </ul>

            <div class="d-flex justify-content-between mb-3">
                <span class="fw-bold">Subtotal</span>
                <span class="fw-bold text-success">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <form action="{{ url('/pelanggan/checkout/proses') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Catatan Pesanan (Opsional)</label>
                    <textarea name="catatan" class="form-control" rows="3" placeholder="Misal: tanpa es, pedas sedang..."></textarea>
                </div>

                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-check-circle"></i> Konfirmasi Checkout
                </button>
            </form>

        </div>
    </div>

</div>
@endsection