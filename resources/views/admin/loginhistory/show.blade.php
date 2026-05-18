@extends('layouts.appadmin')

@section('title', 'Detail Login History')

@section('content')

<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        

        <a href="{{ route('loginhistory.index') }}" class="btn btn-secondary btn-sm">
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
                        <th width="30%">User</th>
                        <td>{{ $data->user->name ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $data->user->username ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>IP Address</th>
                        <td>{{ $data->ipaddress }}</td>
                    </tr>
                    <tr>
                        <th>User Agent</th>
                        <td>{{ $data->useragent }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($data->status == 'success')
                                <span class="badge badge-success">SUCCESS</span>
                            @else
                                <span class="badge badge-danger">{{ strtoupper($data->status) }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Login At</th>
                        <td>{{ $data->loginat }}</td>
                    </tr>
                    <tr>
                        <th>Logout At</th>
                        <td>{{ $data->logoutat ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ $data->created_at }}</td>
                    </tr>
                </table>

            </div>
        </div>

    </div>
</section>

@endsection