@extends('layouts.appadmin')

@section('title', 'Detail Ulasan')

@section('content')
<div class="container-fluid py-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold mb-0">Detail Ulasan</h3>

        <a href="{{ route('admin.ulasan.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white fw-bold">
            Informasi Ulasan
        </div>

        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="mb-1"><b>Invoice:</b></p>
                    <p class="text-primary fw-bold">
                        {{ $data->penjualan->kodeinvoice ?? '-' }}
                    </p>
                </div>

                <div class="col-md-6">
                    <p class="mb-1"><b>Tanggal Ulasan:</b></p>
                    <p>
                        {{ $data->tanggal ? \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y H:i') : '-' }}
                    </p>
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="mb-1"><b>Nama Pelanggan:</b></p>
                    <p class="fw-bold">
                        {{ $data->pelanggan->nama ?? 'Tidak diketahui' }}
                    </p>
                </div>

                <div class="col-md-6">
                    <p class="mb-1"><b>Produk:</b></p>
                    <p class="fw-bold text-success">
                        {{ $data->produk->namaproduk ?? '-' }}
                    </p>
                </div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="mb-1"><b>Rating:</b></p>
                    <h4 class="fw-bold text-warning">
                        ⭐ {{ $data->rating }}/5
                    </h4>
                </div>

                <div class="col-md-6">
                    <p class="mb-1"><b>Komentar:</b></p>
                    <div class="border rounded p-3 bg-light">
                        {{ $data->komentar ?? 'Tidak ada komentar.' }}
                    </div>
                </div>
            </div>

            <hr>

            <div class="d-flex justify-content-end">
                <form action="{{ route('admin.ulasan.destroy', $data->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger">
                        <i class="bi bi-trash-fill"></i> Hapus Ulasan
                    </button>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection