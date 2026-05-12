@extends('layouts.appguest')

@section('title', 'Menu')

@section('content')
<section class="py-5" style="margin-top:90px;">
    <div class="container">

        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Menu CAFEPOS</h2>
            <p class="text-white-50">
                Pilihan menu terbaik dengan harga terjangkau dan rasa berkualitas.
            </p>
        </div>

        <!-- SEARCH -->
        <div class="row justify-content-center mb-4" data-aos="fade-up">
            <div class="col-md-8">
                <div class="glass-card">
                    <form action="{{ route('landing.menu') }}" method="GET">
                        <div class="input-group">

                            <input type="text"
                                name="q"
                                value="{{ request('q') }}"
                                class="form-control bg-dark text-white border-0"
                                placeholder="Cari menu...">

                            <button class="btn btn-gradient px-4" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i> Cari
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- MENU LIST -->
        <div class="row g-4">

            @forelse($produk as $row)
                <div class="col-md-4" data-aos="zoom-in">

                    <div class="glass-card">

                        {{-- GAMBAR --}}
                        @if($row->foto)
                            <img src="{{ asset('storage/' . $row->foto) }}"
                                class="img-fluid rounded-4 mb-3"
                                style="width:100%; height:220px; object-fit:cover;"
                                alt="{{ $row->namaproduk }}">
                        @else
                            <img src="{{ asset('dist/img/user2-160x160.jpg') }}"
                                class="img-fluid rounded-4 mb-3"
                                style="width:100%; height:220px; object-fit:cover;"
                                alt="Menu">
                        @endif

                        {{-- INFO --}}
                        <h5 class="fw-bold">{{ $row->namaproduk }}</h5>

                        <p class="text-white-50 mb-2">
                            Kode: {{ $row->kodeproduk }} <br>
                            Satuan: {{ $row->satuan }}
                        </p>

                        <h6 class="text-warning fw-bold">
                            Rp {{ number_format($row->hargajual, 0, ',', '.') }}
                        </h6>

                        {{-- ========================= --}}
                        {{-- BUTTON ACTION (FINAL FIX) --}}
                        {{-- ========================= --}}

                        <div class="mt-3">

                            {{-- JIKA SUDAH LOGIN PELANGGAN --}}
                            @if(Auth::guard('pelanggan')->check())

                                <a href="{{ route('pelanggan.keranjang.tambah', $row->id) }}"
                                   class="btn btn-success w-100">
                                    + Tambah ke Keranjang
                                </a>

                            {{-- JIKA BELUM LOGIN --}}
                            @else

                                <a href="{{ route('auth.pilihlogin') }}"
                                   class="btn btn-warning w-100">
                                    Login untuk Pesan
                                </a>

                            @endif

                        </div>

                    </div>

                </div>
            @empty

                <div class="col-12 text-center">
                    <div class="glass-card">
                        <h5 class="fw-bold">Menu belum tersedia</h5>
                        <p class="text-white-50 mb-0">
                            Silakan tambahkan produk di dashboard admin.
                        </p>
                    </div>
                </div>

            @endforelse

        </div>

    </div>
</section>
@endsection