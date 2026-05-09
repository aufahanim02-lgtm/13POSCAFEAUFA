@extends('layouts.appadmin')

@section('title', 'Data Stok Keluar')

@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Data Stok Keluar</h4>
            <small class="text-muted">Daftar transaksi stok keluar bahan baku</small>
        </div>

        <a href="{{ route('inventory.stokkeluar.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            @if($data->count() == 0)
                <div class="alert alert-warning mb-0">
                    Data stok keluar masih kosong.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Bahan Baku</th>
                                <th width="15%">Jumlah</th>
                                <th width="20%">Tanggal Keluar</th>
                                <th>Alasan</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>
                                        <b>{{ $item->bahanbaku->namabahan ?? '-' }}</b>
                                        <br>
                                        <small class="text-muted">ID: {{ $item->bahanbakuid }}</small>
                                    </td>

                                    <td class="text-center">
                                        <b>{{ $item->jumlah ?? 0 }}</b>
                                    </td>

                                    <td class="text-center">
                                        {{ $item->tanggalkeluar ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $item->alasan ?? '-' }}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('inventory.stokkeluar.show', $item->id) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('inventory.stokkeluar.edit', $item->id) }}"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="{{ route('inventory.stokkeluar.destroy', $item->id) }}"
                                           onclick="return confirm('Yakin ingin menghapus data ini?')"
                                           class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>

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