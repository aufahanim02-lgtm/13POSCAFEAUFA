@extends('layouts.apppelanggan')

@section('title', 'Detail Menu')

@section('content')
<div class="container py-4">

    <a href="{{ url('/pelanggan/menu') }}" class="btn btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 rounded-4">
                <img src="{{ asset('storage/produk/'.$produk->foto) }}" class="rounded-4" style="width:100%; height:350px; object-fit:cover;">
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="fw-bold">{{ $produk->namaproduk }}</h3>
                    <p class="text-muted">{{ $produk->deskripsi }}</p>

                    <h4 class="fw-bold text-success mb-3">
                        Rp {{ number_format($produk->hargajual, 0, ',', '.') }}
                    </h4>

                    <p class="mb-2">
                        <b>Stok:</b> {{ $produk->stokproduk }}
                    </p>
                    <p class="mb-4">
                        <b>Status:</b>
                        @if($produk->status == 'aktif')
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </p>

                    <div class="d-flex gap-2">
                        <form action="{{ url('/pelanggan/keranjang/tambah/'.$produk->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary">
                                <i class="bi bi-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </form>

                        <form action="{{ url('/pelanggan/wishlist/tambah/'.$produk->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger">
                                <i class="bi bi-heart"></i> Wishlist
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection