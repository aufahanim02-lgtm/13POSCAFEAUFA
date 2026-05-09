@extends('layouts.appadmin')

@section('title', 'Data Pembelian')

@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Data Pembelian</h4>
            <small class="text-muted">Daftar transaksi pembelian bahan baku</small>
        </div>

        <a href="{{ route('inventory.pembelian.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Pembelian
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($data->count() == 0)
        <div class="alert alert-warning">
            Data pembelian masih kosong.
        </div>
    @else
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Kode Pembelian</th>
                                <th>Supplier ID</th>
                                <th>User ID</th>
                                <th width="20%">Total</th>
                                <th width="20%">Tanggal Pembelian</th>
                                <th width="10%">Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <b>{{ $item->kodepembelian ?? '-' }}</b>
                                </td>
                                <td>{{ $item->supplierid }}</td>
                                <td>{{ $item->userid }}</td>
                                <td>
                                    Rp {{ number_format($item->total ?? 0, 0, ',', '.') }}
                                </td>
                                <td>
                                    {{ $item->tanggalpembelian ?? '-' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('inventory.pembelian.show', $item->id) }}"
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @endif

</div>
@endsection