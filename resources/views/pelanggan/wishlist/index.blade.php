@extends('layouts.apppelanggan')

@section('title', 'Wishlist')

@section('content')

<div class="container-fluid">

    <div class="card border-0 shadow-sm rounded-4">

        <div class="card-header bg-danger text-white">

            <h5 class="mb-0">
                Wishlist Saya
            </h5>

        </div>

        <div class="card-body">

            <div class="row g-4">

                @forelse($wishlist as $item)

                    <div class="col-md-3">

                        <div class="card border-0 shadow-sm rounded-4 h-100">

                            @if($item->produk?->foto)

                                <img src="{{ asset('storage/' . $item->produk->foto) }}"
                                    class="card-img-top"
                                    style="height:200px; object-fit:cover;">

                            @endif

                            <div class="card-body">

                                <h6 class="fw-bold">

                                    {{ $item->produk?->namaproduk }}

                                </h6>

                                <p class="text-success fw-bold">

                                    Rp {{ number_format($item->produk?->hargajual,0,',','.') }}

                                </p>

                                <form action="{{ route('pelanggan.wishlist.hapus', $item->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm w-100">

                                        Hapus Wishlist

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="alert alert-info">

                            Wishlist masih kosong.

                        </div>

                    </div>

                @endforelse

            </div>

        </div>

    </div>

</div>

@endsection