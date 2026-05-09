@extends('layouts.appadmin')

@section('title', 'Detail Transaksi')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1>Detail Transaksi</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary card-outline">

                <div class="card-header">
                    <h3 class="card-title">
                        {{ $data->kodeinvoice }}
                    </h3>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">

                        <tr>
                            <th width="250">Kasir</th>
                            <td>{{ $data->user->name ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Meja</th>
                            <td>{{ $data->meja->nomormeja ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>{{ strtoupper($data->status) }}</td>
                        </tr>

                        <tr>
                            <th>Total</th>
                            <td>
                                Rp {{ number_format($data->total,0,',','.') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Tanggal</th>
                            <td>{{ $data->tanggalpenjualan }}</td>
                        </tr>

                    </table>

                    <hr>

                    <h5>Detail Produk</h5>

                    <table class="table table-bordered">

                        <thead class="bg-light">

                            <tr>
                                <th>Produk</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data->detailpenjualan as $item)

                            <tr>

                                <td>
                                    {{ $item->produk->namaproduk ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->qty }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->harga,0,',','.') }}
                                </td>

                                <td>
                                    Rp {{ number_format($item->subtotal,0,',','.') }}
                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </section>

</div>

@endsection