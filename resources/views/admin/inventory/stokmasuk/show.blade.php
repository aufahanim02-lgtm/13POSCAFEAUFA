@extends('layouts.appadmin')

@section('title', 'Detail Stok Masuk')

@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Detail Stok Masuk</h4>
            <small class="text-muted">Informasi detail stok masuk</small>
        </div>

        <a href="{{ route('inventory.stokmasuk.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th width="30%">Nama Bahan Baku</th>
                    <td>{{ $data->bahanbaku->namabahan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Satuan</th>
                    <td>{{ $data->bahanbaku->satuan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Jumlah Masuk</th>
                    <td><b>{{ $data->jumlah ?? 0 }}</b></td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>{{ $data->tanggalmasuk ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $data->keterangan ?? '-' }}</td>
                </tr>
            </table>

        </div>
    </div>

</div>
@endsection