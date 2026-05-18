@extends('layouts.appadmin')



@section('content')

<div class="card">

    <div class="card-header">
        Detail Stok Keluar
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
                <th>Tanggal Keluar</th>
                <td>{{ $data->tanggalkeluar }}</td>
            </tr>

            <tr>
                <th>Alasan</th>
                <td>{{ $data->alasan }}</td>
            </tr>

        </table>

        <a href="{{ route('inventory.stokkeluar.index') }}"
           class="btn btn-secondary">
            Kembali
        </a>

    </div>

</div>

@endsection