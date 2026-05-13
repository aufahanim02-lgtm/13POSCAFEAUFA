@extends('layouts.apppelanggan')

@section('title', 'Detail Menu')

@section('content')

<div class="container py-4">

    <a href="{{ route('pelanggan.menu.index') }}"
        class="btn btn-outline-secondary mb-4">

        <i class="fa-solid fa-arrow-left"></i>
        Kembali
    </a>

    <div class="row g-4">

        {{-- FOTO --}}
        <div class="col-lg-5">

            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">

                @if($produk->foto)

                    <img src="{{ asset('storage/'.$produk->foto) }}"
                        class="rounded-4"
                        style="width:100%; height:350px; object-fit:cover;"
                        alt="{{ $produk->namaproduk }}">

                @else

                    <div class="d-flex justify-content-center align-items-center bg-light"
                        style="height:350px;">

                        <i class="fa-solid fa-image text-muted fs-1"></i>

                    </div>

                @endif

            </div>

        </div>

        {{-- DETAIL --}}
        <div class="col-lg-7">

            <div class="card shadow-sm border-0 rounded-4">

                <div class="card-body p-4">

                    {{-- NAMA --}}
                    <h3 class="fw-bold">
                        {{ $produk->namaproduk }}
                    </h3>

                    {{-- KATEGORI --}}
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill mb-3">

                        {{ $produk->kategori?->namakategori ?? 'Tanpa Kategori' }}

                    </span>

                    {{-- DESKRIPSI --}}
                    <p class="text-muted">
                        {{ $produk->deskripsi ?? 'Tidak ada deskripsi produk.' }}
                    </p>

                    {{-- HARGA --}}
                    <h4 class="fw-bold text-success mb-3">

                        Rp {{ number_format($produk->hargajual, 0, ',', '.') }}

                    </h4>

                    {{-- STOK --}}
                    <p class="mb-2">

                        <b>Stok:</b>

                        @if($produk->stokproduk > 0)

                            <span class="text-success">
                                {{ $produk->stokproduk }}
                            </span>

                        @else

                            <span class="text-danger">
                                Habis
                            </span>

                        @endif

                    </p>

                    {{-- STATUS --}}
                    <p class="mb-4">

                        <b>Status:</b>

                        @if($produk->status == 'aktif')

                            <span class="badge bg-success">
                                Aktif
                            </span>

                        @else

                            <span class="badge bg-danger">
                                Nonaktif
                            </span>

                        @endif

                    </p>

                    {{-- BUTTON --}}
                    <div class="d-flex gap-2">

                        @if($produk->stokproduk <= 0)

                            <button class="btn btn-secondary" disabled>

                                <i class="fa-solid fa-cart-plus"></i>
                                Stok Habis

                            </button>

                        @else

                            <form action="{{ route('pelanggan.keranjang.tambah', $produk->id) }}"
                                method="POST">

                                @csrf

                                <button class="btn btn-primary">

                                    <i class="fa-solid fa-cart-plus"></i>
                                    Tambah ke Keranjang

                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection