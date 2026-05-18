@extends('layouts.appadmin')

@section('content')

<div class="card shadow-sm border-0">

    {{-- HEADER --}}
    <div class="card-header bg-white d-flex justify-content-between align-items-center">

        <div>
            <h3 class="card-title fw-bold mb-0">
                <i class="fas fa-users text-primary"></i>
                Data User
            </h3>
            <small class="text-muted">
                Management data user sistem
            </small>
        </div>

        {{-- TOMBOL TAMBAH DI POJOK KANAN --}}
        <a href="{{ route('master.user.create') }}"
            class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-plus-circle"></i>
            Tambah User
        </a>

    </div>

    <div class="card-body">

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}

            <button type="button"
                class="close"
                data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
        @endif

        {{-- ALERT ERROR --}}
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-times-circle"></i>
            {{ session('error') }}

            <button type="button"
                class="close"
                data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
        @endif

        {{-- SEARCH --}}
        <form method="GET"
            action="{{ route('master.user.index') }}"
            class="mb-4">

            <div class="input-group">

                <input type="text"
                    name="q"
                    value="{{ request('q') }}"
                    class="form-control"
                    placeholder="Cari nama / username / email...">

                <button class="btn btn-dark">
                    <i class="fas fa-search"></i>
                    Cari
                </button>

            </div>

        </form>

        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="bg-dark text-white text-center">

                    <tr>
                        <th width="5%">No</th>
                        <th width="10%">Foto</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th width="10%">Role</th>
                        <th width="10%">Status</th>
                        <th width="18%">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($data as $no => $row)

                    <tr>

                        {{-- NO --}}
                        <td class="text-center fw-bold">
                            {{ $no + 1 }}
                        </td>

                        {{-- FOTO --}}
                        <td class="text-center">

                            @if($row->foto)

                            <img src="{{ asset('storage/' . $row->foto) }}"
                                width="65"
                                height="65"
                                class="shadow-sm border"
                                style="object-fit:cover; border-radius:10px;">

                            @else

                            <img src="{{ asset('dist/img/user2-160x160.jpg') }}"
                                width="65"
                                height="65"
                                class="shadow-sm border"
                                style="object-fit:cover; border-radius:10px;">

                            @endif

                        </td>

                        {{-- DATA --}}
                        <td class="fw-bold">
                            {{ $row->name }}
                        </td>

                        <td>
                            {{ $row->username }}
                        </td>

                        <td>
                            {{ $row->email }}
                        </td>

                        {{-- ROLE --}}
                        <td class="text-center">

                            @if($row->role == 'owner')

                            <span class="badge badge-danger px-3 py-2">
                                <i class="fas fa-crown"></i>
                                OWNER
                            </span>

                            @elseif($row->role == 'manager')

                            <span class="badge badge-warning px-3 py-2">
                                <i class="fas fa-user-tie"></i>
                                MANAGER
                            </span>

                            @else

                            <span class="badge badge-info px-3 py-2">
                                <i class="fas fa-cash-register"></i>
                                KASIR
                            </span>

                            @endif

                        </td>

                        {{-- STATUS --}}
                        <td class="text-center">

                            @if($row->isactive == 1)

                            <span class="badge badge-success px-3 py-2">
                                <i class="fas fa-check-circle"></i>
                                AKTIF
                            </span>

                            @else

                            <span class="badge badge-secondary px-3 py-2">
                                <i class="fas fa-times-circle"></i>
                                NONAKTIF
                            </span>

                            @endif

                        </td>

                        {{-- AKSI --}}
                        <td class="text-center">

                            {{-- DETAIL --}}
                            <a href="{{ route('master.user.show', $row->id) }}"
                                class="btn btn-info btn-sm shadow-sm"
                                title="Detail">

                                <i class="fas fa-eye"></i>

                            </a>

                            {{-- EDIT --}}
                            <a href="{{ route('master.user.edit', $row->id) }}"
                                class="btn btn-warning btn-sm shadow-sm"
                                title="Edit">

                                <i class="fas fa-edit"></i>

                            </a>

                            {{-- HAPUS --}}
                            <form action="{{ route('master.user.destroy', $row->id) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm shadow-sm"
                                    title="Hapus">

                                    <i class="fas fa-trash-alt"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="8"
                            class="text-center text-muted py-4">

                            <i class="fas fa-folder-open fa-2x mb-2"></i>
                            <br>

                            Data user belum tersedia.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection