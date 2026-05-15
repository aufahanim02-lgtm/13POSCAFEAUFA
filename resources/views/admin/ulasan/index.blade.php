@extends('layouts.appadmin')

@section('title', 'Data Ulasan Pelanggan')

@section('content')
<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold mb-0">Data Ulasan Pelanggan</h3>
        <span class="badge bg-primary">Owner Panel</span>
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

    {{-- SEARCH --}}
    <div class="card shadow-sm border-0 mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.ulasan.index') }}">
                <div class="row g-2 align-items-center">
                    <div class="col-md-10">
                        <input type="text" name="search" value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Cari nama produk...">
                    </div>
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold">
            Daftar Ulasan
        </div>

        <div class="card-body">

            @if($data->count() == 0)
                <div class="alert alert-warning mb-0">
                    Belum ada ulasan dari pelanggan.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Pelanggan</th>
                                <th>Produk</th>
                                <th>Rating</th>
                                <th>Komentar</th>
                                <th>Tanggal</th>
                                <th width="180">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>

                                    <td class="fw-bold text-primary">
                                        {{ $item->penjualan->kodeinvoice ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->pelanggan->nama ?? 'Tidak diketahui' }}
                                    </td>

                                    <td>
                                        <span class="fw-bold">
                                            {{ $item->produk->namaproduk ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            ⭐ {{ $item->rating }}/5
                                        </span>
                                    </td>

                                    <td>
                                        {{ $item->komentar ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y H:i') : '-' }}
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.ulasan.show', $item->id) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <form action="{{ route('admin.ulasan.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="mt-3">
                    {{ $data->links() }}
                </div>
            @endif

        </div>
    </div>

</div>
@endsection