@extends('layouts.apppelanggan')

@section('title', 'Ulasan Saya')

@section('content')
@php
    use Carbon\Carbon;
@endphp

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">⭐ Ulasan Saya</h3>
            <p class="text-muted mb-0">Daftar ulasan yang sudah kamu berikan ke produk.</p>
        </div>

        <a href="{{ route('pelanggan.menu.index') }}" class="btn btn-primary rounded-3 px-4">
            <i class="fa-solid fa-utensils me-2"></i> Cari Menu
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            <b>Berhasil!</b> {{ session('success') }}
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger shadow-sm">
            <b>Gagal!</b> {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            @if(isset($ulasan) && $ulasan->count() > 0)

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width:240px;">Produk</th>
                                <th style="width:120px;">Rating</th>
                                <th>Komentar</th>
                                <th style="width:180px;">Tanggal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($ulasan as $row)
                                <tr>

                                    {{-- PRODUK --}}
                                    <td>
                                        <div class="fw-bold text-dark">
                                            {{ $row->produk->namaproduk ?? '-' }}
                                        </div>
                                        <small class="text-muted">
                                            ID Produk: {{ $row->produkid }}
                                        </small>
                                    </td>

                                    {{-- RATING --}}
                                    <td>
                                        @if($row->rating == 5)
                                            <span class="badge bg-success px-3 py-2">⭐⭐⭐⭐⭐ (5)</span>
                                        @elseif($row->rating == 4)
                                            <span class="badge bg-primary px-3 py-2">⭐⭐⭐⭐ (4)</span>
                                        @elseif($row->rating == 3)
                                            <span class="badge bg-warning text-dark px-3 py-2">⭐⭐⭐ (3)</span>
                                        @elseif($row->rating == 2)
                                            <span class="badge bg-danger px-3 py-2">⭐⭐ (2)</span>
                                        @else
                                            <span class="badge bg-dark px-3 py-2">⭐ (1)</span>
                                        @endif
                                    </td>

                                    {{-- KOMENTAR --}}
                                    <td>
                                        @if($row->komentar)
                                            <span class="text-dark">{{ $row->komentar }}</span>
                                        @else
                                            <span class="text-muted fst-italic">Tidak ada komentar</span>
                                        @endif
                                    </td>

                                    {{-- TANGGAL --}}
                                    <td>
                                        @if($row->tanggal)
                                            <span class="fw-semibold">
                                                {{ Carbon::parse($row->tanggal)->format('d-m-Y') }}
                                            </span>
                                            <br>
                                            <small class="text-muted">
                                                {{ Carbon::parse($row->tanggal)->format('H:i') }}
                                            </small>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            @else
                <div class="text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076508.png"
                         width="120"
                         class="mb-3"
                         alt="Kosong">

                    <h5 class="fw-bold">Belum ada ulasan</h5>
                    <p class="text-muted mb-0">
                        Ulasan akan muncul setelah kamu menyelesaikan pesanan dan memberikan rating.
                    </p>

                    <a href="{{ route('pelanggan.menu.index') }}"
                       class="btn btn-success mt-3 px-4 rounded-3">
                        <i class="fa-solid fa-burger me-2"></i> Pesan Menu Sekarang
                    </a>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection