@extends('layouts.appadmin')

@section('title', 'Data Pelanggan')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0 font-weight-bold">
            <i class="fas fa-users text-primary"></i> Data Pelanggan
        </h3>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        <i class="fas fa-times-circle"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    @endif

    {{-- SEARCH --}}
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.pelanggan.index') }}">
                <div class="row">
                    <div class="col-md-9">
                        <input type="text"
                            name="search"
                            class="form-control"
                            placeholder="Cari pelanggan berdasarkan nama / username / email / nohp..."
                            value="{{ request('search') }}">
                    </div>

                    <div class="col-md-3 d-flex">
                        <button type="submit" class="btn btn-primary btn-block mr-2">
                            <i class="fas fa-search"></i> Cari
                        </button>

                        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary btn-block">
                            <i class="fas fa-sync"></i>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">
                <i class="fas fa-list"></i> List Pelanggan
            </h5>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="bg-light">
                    <tr class="text-center">
                        <th style="width: 60px;">No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Member</th>
                        <th>Point</th>
                        <th style="width: 230px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $row)
                    <tr>
                        <td class="text-center">
                            {{ $loop->iteration + ($data->firstItem() - 1) }}
                        </td>

                        <td class="text-center">
                            @if($row->foto)
                            <img src="{{ asset('storage/pelanggan/' . $row->foto) }}"
                                class="img-thumbnail"
                                style="width:55px; height:55px; object-fit:cover; border-radius:50%;">
                            @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($row->name ?? 'Pelanggan') }}&background=111827&color=fff"
                                class="img-thumbnail"
                                style="width:55px; height:55px; object-fit:cover; border-radius:50%;">
                            @endif
                        </td>

                        <td>
                            <strong>{{ $row->name }}</strong>
                        </td>

                        <td>{{ $row->username }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->nohp ?? '-' }}</td>

                        <td class="text-center">
                            @if($row->status == 'blocked')
                            <span class="badge badge-danger px-3 py-2">
                                <i class="fas fa-ban"></i> BLOCKED
                            </span>
                            @else
                            <span class="badge badge-success px-3 py-2">
                                <i class="fas fa-check-circle"></i> AKTIF
                            </span>
                            @endif
                        </td>

                        <td class="text-center">
                            <span class="badge badge-info px-3 py-2">
                                {{ strtoupper($row->levelmember) }}
                            </span>
                        </td>

                        <td class="text-center">
                            <span class="badge badge-warning px-3 py-2">
                                {{ $row->point }}
                            </span>
                        </td>

                        <td class="text-center">

                            <a href="{{ route('admin.pelanggan.show', $row->id) }}"
                                class="btn btn-sm btn-info mb-1">
                                <i class="fas fa-eye"></i> Detail
                            </a>

                            @if($row->status == 'blocked')
                            <form action="{{ route('admin.pelanggan.aktifkan', $row->id) }}"
                                method="POST"
                                style="display:inline-block;">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm btn-success mb-1"
                                    onclick="return confirm('Aktifkan akun pelanggan ini?')">
                                    <i class="fas fa-check"></i> Aktifkan
                                </button>
                            </form>
                            @else
                            <form action="{{ route('admin.pelanggan.blokir', $row->id) }}"
                                method="POST"
                                style="display:inline-block;">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm btn-warning mb-1"
                                    onclick="return confirm('Blokir akun pelanggan ini?')">
                                    <i class="fas fa-ban"></i> Blokir
                                </button>
                            </form>
                            @endif

                            <form action="{{ route('admin.pelanggan.destroy', $row->id) }}"
                                method="POST"
                                style="display:inline-block;"
                                onsubmit="return confirm('Yakin hapus pelanggan ini? Semua transaksi pelanggan tetap aman, tapi akun hilang.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mb-1">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">
                            <i class="fas fa-info-circle"></i> Data pelanggan belum ada.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- PAGINATION --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $data->links() }}
            </div>

        </div>
    </div>

</div>

@endsection