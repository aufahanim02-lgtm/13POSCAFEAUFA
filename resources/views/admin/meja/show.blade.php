@extends('layouts.appadmin')

@section('title', 'Detail Meja')

@section('content')

<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0">Detail Meja</h1>
            <small class="text-muted">Informasi lengkap meja</small>
        </div>

        <a href="{{ route('master.meja.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered">
                    <tr>
                        <th width="30%">Nomor Meja</th>
                        <td>{{ $data->nomormeja }}</td>
                    </tr>
                    <tr>
                        <th>Kapasitas</th>
                        <td>{{ $data->kapasitas }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($data->status == 'kosong')
                                <span class="badge badge-success">Kosong</span>
                            @elseif($data->status == 'terisi')
                                <span class="badge badge-danger">Terisi</span>
                            @else
                                <span class="badge badge-secondary">{{ $data->status }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Dibuat</th>
                        <td>{{ $data->created_at ? $data->created_at->format('d-m-Y H:i') : '-' }}</td>
                    </tr>
                    <tr>
                        <th>Update Terakhir</th>
                        <td>{{ $data->updated_at ? $data->updated_at->format('d-m-Y H:i') : '-' }}</td>
                    </tr>
                </table>

            </div>
        </div>

    </div>
</section>

@endsection