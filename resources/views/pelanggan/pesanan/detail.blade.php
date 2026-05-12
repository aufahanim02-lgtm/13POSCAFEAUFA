@extends('layouts.apppelanggan')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container py-4">

    <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-secondary btn-sm mb-3">
        Kembali
    </a>

    <div class="card shadow-sm border-0 rounded-4 mb-3">
        <div class="card-body">
            <p class="mb-1"><b>Invoice:</b> {{ $data->kodeinvoice }}</p>
            <p class="mb-1"><b>Meja:</b> {{ $data->meja->nomormeja ?? '-' }}</p>
            <p class="mb-1"><b>Status Pesanan:</b> {{ $data->statuspesanan }}</p>
            <p class="mb-0"><b>Status Bayar:</b> {{ $data->statuspembayaran }}</p>
        </div>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <h6 class="fw-bold mb-3">Daftar Item</h6>

            <ul class="list-group">
                @foreach($data->detail as $item)
                    <li class="list-group-item d-flex justify-content-between">
                        <div>
                            <b>{{ $item->produk->namaproduk ?? '-' }}</b>
                            <br>
                            <small class="text-muted">Qty: {{ $item->qty }}</small>
                            <br>
                            <span class="badge {{ $item->statusitem == 'habis' ? 'bg-danger' : 'bg-success' }}">
                                {{ $item->statusitem }}
                            </span>
                        </div>
                        <div class="fw-bold">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </div>
                    </li>
                @endforeach
            </ul>

            <hr>

            <div class="d-flex justify-content-between">
                <b>Total</b>
                <b>Rp {{ number_format($data->total, 0, ',', '.') }}</b>
            </div>

        </div>
    </div>

</div>
@endsection