@extends('layouts.appmanager')

@section('title', 'Detail Stok Masuk')

@section('content')
<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0">Detail Stok Masuk</h1>
            <small class="text-muted">Informasi detail stok masuk bahan baku</small>
        </div>

        <a href="{{ route('inventory.stokmasuk.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

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
                    <tr>
                        <th>Created At</th>
                        <td>{{ $data->created_at ? $data->created_at->format('d-m-Y H:i') : '-' }}</td>
                    </tr>
                </table>

            </div>
        </div>

    </div>
</section>
@endsection