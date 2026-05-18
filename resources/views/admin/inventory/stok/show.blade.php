@extends('layouts.appadmin')



@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Detail Stok</h4>
            <small class="text-muted">Informasi detail stok bahan baku</small>
        </div>

        <a href="{{ route('inventory.stok.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            @php
                $stokTersedia = $data->stoktersedia ?? 0;
                $stokMinimal  = $data->stokminimal ?? 0;

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
                    <th>Stok Tersedia</th>
                    <td><b>{{ $stokTersedia }}</b></td>
                </tr>
                <tr>
                    <th>Stok Minimal</th>
                    <td><b>{{ $stokMinimal }}</b></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-{{ $badgeClass }}">{{ $statusText }}</span>
                    </td>
                </tr>
                <tr>
                    <th>Update Terakhir</th>
                    <td>{{ $data->updated_at ? $data->updated_at->format('d-m-Y H:i') : '-' }}</td>
                </tr>
            </table>

        </div>
    </div>

</div>
@endsection