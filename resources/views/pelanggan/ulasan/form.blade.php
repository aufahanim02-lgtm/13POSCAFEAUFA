@extends('layouts.apppelanggan')

@section('title', 'Form Ulasan')

@section('content')
<div class="container py-4">

    <div class="mb-3">
        <h3 class="fw-bold mb-1">Form Ulasan Pesanan</h3>
        <p class="text-muted mb-0">
            Invoice: <span class="fw-bold text-primary">{{ $penjualan->kodeinvoice }}</span>
        </p>
    </div>

    {{-- ALERT ERROR VALIDASI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ALERT SESSION --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">

            <div class="row mb-2">
                <div class="col-md-6">
                    <p class="mb-1"><b>Status Pesanan:</b>
                        <span class="badge bg-success">{{ strtoupper($penjualan->statuspesanan) }}</span>
                    </p>
                </div>

                <div class="col-md-6">
                    <p class="mb-1"><b>Status Pembayaran:</b>
                        <span class="badge bg-primary">{{ strtoupper($penjualan->statuspembayaran) }}</span>
                    </p>
                </div>
            </div>

            <p class="mb-0">
                Silakan beri rating dan komentar untuk setiap produk yang kamu pesan.
            </p>

        </div>
    </div>

    <form action="{{ route('pelanggan.ulasan.store', $penjualan->id) }}" method="POST">
        @csrf

        <div class="card shadow-sm border-0">
            <div class="card-header bg-white fw-bold">
                Produk dalam Pesanan
            </div>

            <div class="card-body">

                @foreach($penjualan->detail as $item)
                    <div class="border rounded p-3 mb-3">

                        <div class="row align-items-center">
                            <div class="col-md-7">
                                <h5 class="fw-bold mb-1">{{ $item->produk->namaproduk ?? 'Produk Tidak Ditemukan' }}</h5>
                                <p class="mb-0 text-muted">
                                    Qty: <b>{{ $item->qty }}</b>
                                </p>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label fw-bold mb-1">Rating</label>
                                <select name="rating[{{ $item->produkid }}]" class="form-select" required>
                                    <option value="">-- Pilih Rating --</option>
                                    <option value="1">⭐ 1 - Sangat Buruk</option>
                                    <option value="2">⭐⭐ 2 - Buruk</option>
                                    <option value="3">⭐⭐⭐ 3 - Cukup</option>
                                    <option value="4">⭐⭐⭐⭐ 4 - Bagus</option>
                                    <option value="5">⭐⭐⭐⭐⭐ 5 - Sangat Bagus</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label class="form-label fw-bold mb-1">Komentar (Opsional)</label>
                            <textarea name="komentar[{{ $item->produkid }}]" rows="2" class="form-control"
                                placeholder="Tulis komentar tentang produk ini..."></textarea>
                        </div>

                    </div>
                @endforeach

            </div>

            <div class="card-footer bg-white d-flex justify-content-between">
                <a href="{{ route('pelanggan.ulasan.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-send-fill"></i> Kirim Ulasan
                </button>
            </div>
        </div>

    </form>

</div>
@endsection