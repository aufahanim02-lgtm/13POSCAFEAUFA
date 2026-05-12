@extends('layouts.apppelanggan')

@section('title', 'Wishlist')

@section('content')
<div class="container py-4">

    <h3 class="fw-bold mb-3">Wishlist Saya</h3>

    <div class="row g-4">
        @forelse($wishlist as $row)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card shadow-sm border-0 rounded-4 h-100">
                    <img src="{{ asset('storage/produk/'.$row->produk->foto) }}" class="card-img-top rounded-top-4" style="height:200px; object-fit:cover;">
                    <div class="card-body">
                        <h6 class="fw-bold mb-1">{{ $row->produk->namaproduk ?? '-' }}</h6>
                        <p class="text-success fw-bold mb-3">
                            Rp {{ number_format($row->produk->hargajual ?? 0, 0, ',', '.') }}
                        </p>

                        <div class="d-flex gap-2">
                            <a href="{{ url('/pelanggan/menu/detail/'.$row->produk->id) }}" class="btn btn-sm btn-outline-primary w-100">
                                Detail
                            </a>

                            <form action="{{ url('/pelanggan/wishlist/hapus/'.$row->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus wishlist ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <h5 class="fw-bold">Wishlist kosong</h5>
                <p class="text-muted">Tambahkan produk favorit ke wishlist.</p>
                <a href="{{ url('/pelanggan/menu') }}" class="btn btn-primary">Lihat Menu</a>
            </div>
        @endforelse
    </div>

</div>
@endsection