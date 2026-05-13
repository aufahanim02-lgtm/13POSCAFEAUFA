@extends('layouts.apppelanggan')

@php
    use Illuminate\Support\Str;
@endphp

@section('title', 'Menu Cafe')
@section('header', 'Menu Cafe')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Menu Cafe</h3>
            <p class="text-muted mb-0">
                Silahkan pilih menu favoritmu dan lakukan pemesanan.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('pelanggan.keranjang.index') }}"
                class="btn btn-success rounded-3 px-4">

                <i class="fa-solid fa-cart-shopping me-2"></i>
                Keranjang
            </a>
        </div>
    </div>

    {{-- SEARCH --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-3 p-md-4">

            <form method="GET" action="{{ route('pelanggan.menu.index') }}">

                <div class="row g-2 align-items-center">

                    <div class="col-md-10">
                        <div class="input-group">

                            <span class="input-group-text bg-white border-0">
                                <i class="fa-solid fa-magnifying-glass text-muted"></i>
                            </span>

                            <input type="text"
                                name="q"
                                value="{{ request('q') }}"
                                class="form-control border-0"
                                placeholder="Cari menu berdasarkan nama produk...">

                        </div>
                    </div>

                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary rounded-3">
                            <i class="fa-solid fa-search me-1"></i>
                            Cari
                        </button>
                    </div>

                </div>

                @if(request('q'))

                    <div class="mt-3">

                        <span class="text-muted small">
                            Hasil pencarian untuk:
                            <b>"{{ request('q') }}"</b>
                        </span>

                        <a href="{{ route('pelanggan.menu.index') }}"
                            class="btn btn-sm btn-light ms-2">

                            Reset
                        </a>

                    </div>

                @endif

            </form>

        </div>
    </div>

    {{-- LIST MENU --}}
    <div class="row g-4">

        @forelse($produk as $row)

            <div class="col-lg-3 col-md-4 col-sm-6">

                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">

                    {{-- FOTO --}}
                    @if($row->foto)

                        <img src="{{ asset('storage/'.$row->foto) }}"
                            class="w-100"
                            style="height:200px; object-fit:cover;"
                            alt="{{ $row->namaproduk }}">

                    @else

                        <div class="d-flex justify-content-center align-items-center bg-light"
                            style="height:200px;">

                            <i class="fa-solid fa-image text-muted fs-1"></i>

                        </div>

                    @endif

                    <div class="card-body p-3">

                        {{-- KATEGORI --}}
                        <div class="d-flex justify-content-between align-items-center mb-2">

                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                {{ $row->kategori?->namakategori ?? 'Tanpa Kategori' }}
                            </span>

                            @if($row->stokproduk <= 0)

                                <span class="badge bg-danger px-3 py-2 rounded-pill">
                                    Stok Habis
                                </span>

                            @else

                                <span class="badge bg-success px-3 py-2 rounded-pill">
                                    Stok: {{ $row->stokproduk }}
                                </span>

                            @endif

                        </div>

                        {{-- NAMA PRODUK --}}
                        <h6 class="fw-bold mb-1 text-dark">
                            {{ $row->namaproduk }}
                        </h6>

                        {{-- DESKRIPSI --}}
                        <p class="text-muted small mb-2" style="min-height:40px;">

                            {{ $row->deskripsi
                                ? Str::limit($row->deskripsi, 70)
                                : 'Tidak ada deskripsi produk.' }}

                        </p>

                        {{-- HARGA --}}
                        <h5 class="fw-bold text-success mb-3">
                            Rp {{ number_format($row->hargajual, 0, ',', '.') }}
                        </h5>

                        {{-- BUTTON --}}
                        <div class="d-flex gap-2">

                            <a href="{{ route('pelanggan.menu.detail', $row->id) }}"
                                class="btn btn-outline-primary btn-sm rounded-3 w-100">

                                <i class="fa-solid fa-circle-info me-1"></i>
                                Detail
                            </a>

                            @if($row->stokproduk <= 0)

                                <button class="btn btn-secondary btn-sm rounded-3 w-100" disabled>
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>

                            @else

                                <form action="{{ route('pelanggan.keranjang.tambah', $row->id) }}"
                                    method="POST"
                                    class="w-100">

                                    @csrf

                                    <button type="submit"
                                        class="btn btn-primary btn-sm rounded-3 w-100">

                                        <i class="fa-solid fa-cart-plus"></i>
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        @empty

            <div class="col-12">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body text-center py-5">

                        <i class="fa-solid fa-mug-hot fs-1 text-muted mb-3"></i>

                        <h5 class="fw-bold mb-2">
                            Menu tidak ditemukan
                        </h5>

                        <p class="text-muted mb-0">
                            Tidak ada menu yang sesuai dengan pencarian kamu.
                        </p>

                    </div>

                </div>

            </div>

        @endforelse

    </div>

</div>
@endsection