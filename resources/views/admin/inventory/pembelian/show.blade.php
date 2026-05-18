@extends('layouts.appadmin')


@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Detail Pembelian</h4>
            <small class="text-muted">Informasi transaksi pembelian</small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('inventory.pembelian.edit', $pembelian->id) }}" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i> Edit
            </a>

            <a href="{{ route('inventory.pembelian.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-header">
            <b>Data Pembelian</b>
        </div>
        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th width="25%">Kode Pembelian</th>
                    <td>{{ $pembelian->kodepembelian }}</td>
                </tr>
                <tr>
                    <th>Supplier ID</th>
                    <td>{{ $pembelian->supplierid }}</td>
                </tr>
                <tr>
                    <th>User ID</th>
                    <td>{{ $pembelian->userid }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pembelian</th>
                    <td>{{ $pembelian->tanggalpembelian }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td><b>Rp {{ number_format($pembelian->total ?? 0, 0, ',', '.') }}</b></td>
                </tr>
            </table>

        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header">
            <b>Detail Pembelian</b>
        </div>
        <div class="card-body">

            @if($detail->count() == 0)
                <div class="alert alert-warning mb-0">
                    Tidak ada detail pembelian.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Bahan Baku ID</th>
                                <th width="15%">Qty</th>
                                <th width="20%">Harga</th>
                                <th width="20%">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->bahanbakuid }}</td>
                                    <td class="text-center">{{ $item->qty }}</td>
                                    <td>Rp {{ number_format($item->harga ?? 0, 0, ',', '.') }}</td>
                                    <td><b>Rp {{ number_format($item->subtotal ?? 0, 0, ',', '.') }}</b></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection