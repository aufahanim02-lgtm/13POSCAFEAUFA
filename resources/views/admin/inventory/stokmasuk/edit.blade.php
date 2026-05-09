@extends('layouts.appadmin')

@section('title', 'Edit Stok Masuk')

@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Edit Stok Masuk</h4>
            <small class="text-muted">Update transaksi stok masuk</small>
        </div>

        <a href="{{ route('inventory.stokmasuk.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('inventory.stokmasuk.update', $data->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Bahan Baku ID</label>
                    <input type="number" name="bahanbakuid" value="{{ $data->bahanbakuid }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" value="{{ $data->jumlah }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Masuk</label>
                    <input type="date" name="tanggalmasuk" value="{{ $data->tanggalmasuk }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control" rows="3">{{ $data->keterangan }}</textarea>
                </div>

                <button class="btn btn-warning btn-sm">
                    <i class="fas fa-save"></i> Update
                </button>
            </form>

        </div>
    </div>

</div>
@endsection