@extends('layouts.appadmin')

@section('title', 'Edit Resep')

@section('content')
<div class="container-fluid">

    <a href="{{ route('master.resep.show', $data->produkid) }}" class="btn btn-secondary mb-3">
        ⬅ Kembali
    </a>

    <div class="card shadow-sm">
        <div class="card-header bg-warning">
            <h5 class="mb-0">✏ Edit Resep</h5>
        </div>

        <div class="card-body">

            <p><b>Produk:</b> {{ $data->produk->namaproduk ?? '-' }}</p>
            <p><b>Bahan Baku:</b> {{ $data->bahanbaku->namabahan ?? '-' }}</p>

            <form method="POST" action="{{ route('master.resep.update', $data->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control"
                           value="{{ $data->jumlah }}" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Satuan</label>
                    <input type="text" name="satuan" class="form-control"
                           value="{{ $data->satuan }}">
                </div>

                <button class="btn btn-success">
                    Update
                </button>
            </form>

        </div>
    </div>

</div>
@endsection