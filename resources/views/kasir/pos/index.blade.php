@extends('layouts.appkasir')

@section('title', 'POS Kasir')

@section('content')


    <!-- HEADER -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h1 class="fw-bold mb-0">POS Kasir</h1>
                    <small class="text-muted">Kelola transaksi dengan cepat & mudah</small>
                </div>

                <div>
                    <span class="badge badge-info p-2">
                        <i class="fas fa-calendar-alt"></i> {{ date('d M Y') }}
                    </span>
                </div>
            </div>
        </div>
    </section>


    <!-- MAIN CONTENT -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <!-- LIST PRODUK -->
                <div class="col-lg-7 col-md-12">
                    <div class="card card-outline card-primary shadow-sm rounded-lg">

                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="card-title fw-bold mb-0">
                                    <i class="fas fa-box"></i> Daftar Produk
                                </h3>

                                <div style="width: 250px;">
                                    <input type="text" id="searchProduk" class="form-control form-control-sm"
                                        placeholder="Cari produk...">
                                </div>
                            </div>
                        </div>

                        <div class="card-body">

                            <div class="row" id="produkContainer">
                                @foreach($produk as $p)
                                <div class="col-lg-4 col-md-6 col-sm-6 mb-3 produk-item"
                                    data-nama="{{ strtolower($p->namaproduk) }}">

                                    <div class="card shadow-sm border-0 rounded-lg h-100">
                                        <div class="card-body text-center">

                                            <div class="mb-2">
                                                @if($p->foto)
                                                <img src="{{ asset('storage/' . $p->foto) }}"
                                                    class="img-fluid rounded"
                                                    style="height:120px; width:100%; object-fit:cover;"
                                                    alt="Foto Produk">
                                                @else
                                                <img src="{{ asset('foto/defaultproduk.png') }}"
                                                    class="img-fluid rounded"
                                                    style="height:120px; width:100%; object-fit:cover;"
                                                    alt="Default Produk">
                                                @endif
                                            </div>

                                            <h6 class="fw-bold mb-1">{{ $p->namaproduk }}</h6>

                                            <p class="text-success fw-bold mb-2">
                                                Rp {{ number_format($p->hargajual) }}
                                            </p>

                                            <form action="{{ route('kasir.pos.tambah') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="produkid" value="{{ $p->id }}">
                                                <button class="btn btn-sm btn-primary w-100 rounded-pill">
                                                    <i class="fas fa-plus"></i> Tambah
                                                </button>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>


                <!-- KERANJANG -->
                <div class="col-lg-5 col-md-12">
                    <div class="card card-outline card-success shadow-sm rounded-lg">

                        <div class="card-header">
                            <h3 class="card-title fw-bold mb-0">
                                <i class="fas fa-shopping-cart"></i> Keranjang
                            </h3>
                        </div>

                        <div class="card-body">

                            @if(session('error'))
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                            </div>
                            @endif

                            @if(session('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>Produk</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-right">Subtotal</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($cart as $item)
                                        <tr>
                                            <td class="fw-bold">{{ $item['namaproduk'] }}</td>
                                            <td class="text-center">{{ $item['qty'] }}</td>
                                            <td class="text-right">
                                                Rp {{ number_format($item['subtotal']) }}
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('kasir.pos.hapus') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="produkid" value="{{ $item['produkid'] }}">
                                                    <button class="btn btn-sm btn-danger rounded-pill">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="fas fa-info-circle"></i> Keranjang masih kosong
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <hr>

                            <!-- TOTAL -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold mb-0">Total</h5>
                                <h4 class="fw-bold text-success mb-0">
                                    Rp {{ number_format($subtotal) }}
                                </h4>
                            </div>

                            <!-- ACTION BUTTON -->
                            <div class="d-flex justify-content-between">
                                <form action="{{ route('kasir.pos.reset') }}" method="POST">
                                    @csrf
                                    <button class="btn btn-outline-danger rounded-pill px-4">
                                        <i class="fas fa-sync"></i> Reset
                                    </button>
                                </form>

                                <a href="{{ route('kasir.pembayaran.index') }}" class="btn btn-success rounded-pill px-4">
                                    <i class="fas fa-credit-card"></i> Bayar
                                </a>
                            </div>

                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

</div>


{{-- SEARCH SCRIPT --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchProduk");
        const produkItems = document.querySelectorAll(".produk-item");

        searchInput.addEventListener("keyup", function() {
            const keyword = searchInput.value.toLowerCase();

            produkItems.forEach(item => {
                const nama = item.getAttribute("data-nama");

                if (nama.includes(keyword)) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });
    });
</script>
@endsection