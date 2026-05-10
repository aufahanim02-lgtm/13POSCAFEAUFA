@extends('layouts.appmanager')

@section('title', 'Detail Stok Masuk')

@section('content')

<div class="card">

    <div class="card-header">
        Detail Stok Masuk
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>Bahan Baku</th>
                <td>{{ $data->bahanbaku->namabahan ?? '-' }}</td>
            </tr>

            <tr>
                <th>Jumlah</th>
                <td>{{ $data->jumlah }}</td>
            </tr>

            <tr>
                <th>Tanggal Masuk</th>
                <td>{{ $data->tanggalmasuk }}</td>
            </tr>

            <tr>
                <th>Keterangan</th>
                <td>{{ $data->keterangan }}</td>
            </tr>

        </table>

        <a href="{{ route('inventory.stokmasuk.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

@endsection