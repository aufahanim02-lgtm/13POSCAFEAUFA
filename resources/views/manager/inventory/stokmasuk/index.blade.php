@extends('layouts.appmanager')

@section('title', 'Data Stok Masuk')

@section('content')
<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0">Data Stok Masuk</h1>
            <small class="text-muted">Monitoring stok masuk bahan baku</small>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-body">

                @if($data->count() == 0)
                    <div class="alert alert-warning mb-0">
                        Data stok masuk masih kosong.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Bahan Baku</th>
                                    <th width="15%">Jumlah</th>
                                    <th width="20%">Tanggal Masuk</th>
                                    <th>Keterangan</th>
                                    <th width="10%">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <b>{{ $item->bahanbaku->namabahan ?? '-' }}</b>
                                            <br>
                                            <small class="text-muted">
                                                ID: {{ $item->bahanbakuid }}
                                            </small>
                                        </td>

                                        <td class="text-center">
                                            <span class="fw-bold">{{ $item->jumlah ?? 0 }}</span>
                                        </td>

                                        <td class="text-center">
                                            {{ $item->tanggalmasuk ?? '-' }}
                                        </td>

                                        <td>
                                            {{ $item->keterangan ?? '-' }}
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('inventory.stokmasuk.show', $item->id) }}"
                                               class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
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
</section>
@endsection