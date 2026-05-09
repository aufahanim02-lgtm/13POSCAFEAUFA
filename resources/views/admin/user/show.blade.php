@extends('layouts.appadmin')

@section('title', 'Detail User')

@section('content')

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title m-0">Detail User</h3>

        <a href="{{ route('master.user.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card-body">

        <div class="text-center mb-4">
            @if($data->foto)
                <img src="{{ asset('storage/' . $data->foto) }}" width="120" height="120"
                    class="rounded-circle shadow" style="object-fit: cover;">
            @else
                <div class="text-muted">Tidak ada foto</div>
            @endif
        </div>

        <table class="table table-bordered">
            <tr>
                <th width="30%">Nama</th>
                <td>{{ $data->name }}</td>
            </tr>
            <tr>
                <th>Username</th>
                <td>{{ $data->username }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $data->email }}</td>
            </tr>
            <tr>
                <th>Role</th>
                <td>
                    @if($data->role == 'owner')
                        <span class="badge badge-danger">OWNER</span>
                    @elseif($data->role == 'manager')
                        <span class="badge badge-warning">MANAGER</span>
                    @else
                        <span class="badge badge-info">KASIR</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @if($data->isactive == 1)
                        <span class="badge badge-success">AKTIF</span>
                    @else
                        <span class="badge badge-secondary">NONAKTIF</span>
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

@endsection