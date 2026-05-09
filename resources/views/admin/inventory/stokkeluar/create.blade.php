@extends('layouts.appadmin')

@section('title', 'Tambah Stok Keluar')

@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Tambah Stok Keluar</h4>
            <small class="text-muted">Input transaksi stok keluar</small>
        </div>

        <a href="{{ route('inventory.stokkeluar.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('inventory.stokkeluar.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Bahan Baku ID</label>
                    <input type="number" name="bahanbakuid" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Keluar</label>
                    <input type="date" name="tanggalkeluar" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alasan</label>
                    <textarea name="alasan" class="form-control" rows="3"></textarea>
                </div>

                <button class="btn btn-primary btn-sm">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </form>

        </div>
    </div>

</div>
@endsection