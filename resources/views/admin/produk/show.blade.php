@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Detail Produk</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Kode Produk</th>
                    <td>{{ $data->kodeproduk }}</td>
                </tr>

                <tr>
                    <th>Nama Produk</th>
                    <td>{{ $data->namaproduk }}</td>
                </tr>

                <tr>
                    <th>Kategori</th>
                    <td>{{ $data->kategori->namakategori ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Harga Jual</th>
                    <td>
                        Rp {{ number_format($data->hargajual,0,',','.') }}
                    </td>
                </tr>

                <tr>
                    <th>Satuan</th>
                    <td>{{ $data->satuan }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ $data->status }}</td>
                </tr>

            </table>

            <a href="{{ route('master.produk.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </div>

</div>

@endsection