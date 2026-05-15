@extends('layouts.apppelanggan')

@section('title', 'Ulasan Pesanan')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold mb-0">Ulasan Pesanan</h3>
        <span class="badge bg-primary">Review per Invoice</span>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold">
            Daftar Invoice Selesai
        </div>

        <div class="card-body">

            @if($data->count() == 0)
                <div class="alert alert-warning mb-0">
                    Belum ada pesanan selesai yang bisa kamu ulas.
                </div>
            @else

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Kode Invoice</th>
                                <th>Tanggal</th>
                                <th>Jumlah Item</th>
                                <th>Status Pesanan</th>
                                <th>Status Pembayaran</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td class="fw-bold text-primary">
                                        {{ $item->kodeinvoice }}
                                    </td>

                                    <td>
                                        {{ $item->tanggalpenjualan ? \Carbon\Carbon::parse($item->tanggalpenjualan)->format('d-m-Y H:i') : '-' }}
                                    </td>

                                    <td>
                                        {{ $item->detail->count() }} Produk
                                    </td>

                                    <td>
                                        <span class="badge bg-success">
                                            {{ strtoupper($item->statuspesanan) }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{ strtoupper($item->statuspembayaran) }}
                                        </span>
                                    </td>

                                    <td>
                                        <a href="{{ route('pelanggan.ulasan.form', $item->id) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="bi bi-star-fill"></i> Beri Ulasan
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            @endif

        </div>
    </div>

</div>
@endsection