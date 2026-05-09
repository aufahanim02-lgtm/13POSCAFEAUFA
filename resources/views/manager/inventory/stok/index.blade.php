@extends('layouts.appmanager')

@section('title', 'Data Stok')

@section('content')
<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0">Data Stok</h1>
            <small class="text-muted">Monitoring stok bahan baku</small>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">

                @if($data->count() == 0)
                    <div class="alert alert-warning mb-0">
                        Data stok masih kosong.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Bahan Baku</th>
                                    <th width="15%">Stok Tersedia</th>
                                    <th width="15%">Stok Minimal</th>
                                    <th width="15%">Status</th>
                                    <th width="20%">Terakhir Update</th>
                                    <th width="10%">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $item)

                                    @php
                                        $stokTersedia = $item->stoktersedia ?? 0;
                                        $stokMinimal  = $item->stokminimal ?? 0;

                                        if($stokTersedia <= 0){
                                            $badgeClass = 'danger';
                                            $statusText = 'Habis';
                                        } elseif($stokTersedia <= $stokMinimal){
                                            $badgeClass = 'warning';
                                            $statusText = 'Menipis';
                                        } else {
                                            $badgeClass = 'success';
                                            $statusText = 'Aman';
                                        }
                                    @endphp

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
                                            <span class="fw-bold">
                                                {{ $stokTersedia }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            {{ $stokMinimal }}
                                        </td>

                                        <td class="text-center">
                                            <span class="badge bg-{{ $badgeClass }}">
                                                {{ $statusText }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $item->updated_at ? $item->updated_at->format('d-m-Y H:i') : '-' }}
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('inventory.stok.show', $item->id) }}"
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