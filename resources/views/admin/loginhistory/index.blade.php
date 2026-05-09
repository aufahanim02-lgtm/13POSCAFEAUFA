@extends('layouts.appadmin')

@section('title', 'Login History')

@section('content')

<div class="content-header">
    <div class="container-fluid">
        <h1 class="m-0">Login History</h1>
        <small class="text-muted">Riwayat login user</small>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>User</th>
                            <th>IP Address</th>
                            <th>Status</th>
                            <th>Login</th>
                            <th>Logout</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $no => $row)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $row->user->name ?? '-' }}</td>
                            <td>{{ $row->ipaddress }}</td>
                            <td>
                                @if($row->status == 'success')
                                    <span class="badge badge-success">SUCCESS</span>
                                @else
                                    <span class="badge badge-danger">{{ strtoupper($row->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $row->loginat }}</td>
                            <td>{{ $row->logoutat ?? '-' }}</td>
                            <td>
                                <a href="{{ route('loginhistory.show', $row->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <form action="{{ route('loginhistory.destroy', $row->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin hapus history ini?')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Data login history kosong</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</section>

@endsection