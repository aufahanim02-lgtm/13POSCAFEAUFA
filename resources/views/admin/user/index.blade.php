@extends('layouts.appadmin')

@section('title', 'Data User')

@section('content')

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title m-0">Data User</h3>

        <a href="{{ route('master.user.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah User
        </a>
    </div>

    <div class="card-body">

        {{-- ALERT --}}
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-times-circle"></i> {{ session('error') }}
            </div>
        @endif

        {{-- SEARCH --}}
        <form method="GET" action="{{ route('master.user.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control"
                    placeholder="Cari nama / username / email...">
                <button class="btn btn-secondary">
                    <i class="fas fa-search"></i> Cari
                </button>
            </div>
        </form>

        <table class="table table-bordered table-striped table-hover">
            <thead class="bg-light">
                <tr class="text-center">
                    <th width="5%">No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th width="10%">Role</th>
                    <th width="10%">Status</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $no => $row)
                <tr>
                    <td class="text-center">{{ $no + 1 }}</td>

                    <td class="text-center">
                        @if($row->foto)
                            <img src="{{ asset('storage/' . $row->foto) }}" width="45" height="45"
                                class="rounded-circle" style="object-fit: cover;">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>

                    <td>{{ $row->name }}</td>
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->email }}</td>

                    <td class="text-center">
                        @if($row->role == 'owner')
                            <span class="badge badge-danger">OWNER</span>
                        @elseif($row->role == 'manager')
                            <span class="badge badge-warning">MANAGER</span>
                        @else
                            <span class="badge badge-info">KASIR</span>
                        @endif
                    </td>

                    <td class="text-center">
                        @if($row->isactive == 1)
                            <span class="badge badge-success">AKTIF</span>
                        @else
                            <span class="badge badge-secondary">NONAKTIF</span>
                        @endif
                    </td>

                    <td class="text-center">
                        <a href="{{ route('master.user.show', $row->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('master.user.edit', $row->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('master.user.destroy', $row->id) }}" method="POST"
                            style="display:inline-block;"
                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">
                        Data user belum tersedia.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection