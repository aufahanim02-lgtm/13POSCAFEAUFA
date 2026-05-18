@extends('layouts.appadmin')


@section('content')

<section class="content">

    <div class="container-fluid">

        <div class="card shadow-sm border-0">

            {{-- HEADER --}}
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">

                <h3 class="card-title m-0">

                    <i class="fas fa-user-circle"></i>
                    Detail User

                </h3>

                <a href="{{ route('master.user.index') }}"
                    class="btn btn-light btn-sm">

                    <i class="fas fa-arrow-left"></i>
                    Kembali

                </a>

            </div>

            {{-- BODY --}}
            <div class="card-body">

                <div class="row">

                    {{-- FOTO USER --}}
                    <div class="col-md-4 text-center border-right">

                        <div class="mb-3">

                            @if($data->foto)

                            <img src="{{ asset('storage/' . $data->foto) }}"
                                class="rounded-circle shadow"
                                alt="Foto User"
                                style="
                                        width: 150px;
                                        height: 150px;
                                        object-fit: cover;
                                        border: 4px solid #f1f1f1;
                                     ">

                            @else

                            <div class="d-flex justify-content-center align-items-center mx-auto rounded-circle bg-light shadow"
                                style="
                                        width:150px;
                                        height:150px;
                                        font-size:60px;
                                        color:#999;
                                     ">

                                <i class="fas fa-user"></i>

                            </div>

                            @endif

                        </div>

                        <h4 class="font-weight-bold mb-1">
                            {{ $data->name }}
                        </h4>

                        <p>{{ $data->username }}</p>

                        {{-- ROLE --}}
                        @if($data->role == 'owner')

                        <span class="badge badge-danger px-3 py-2">
                            <i class="fas fa-crown"></i>
                            OWNER
                        </span>

                        @elseif($data->role == 'manager')

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

                    </div>

                    {{-- DETAIL USER --}}
                    <div class="col-md-8">

                        <table class="table table-bordered table-striped">

                            <tbody>

                                <tr>

                                    <th width="35%">
                                        <i class="fas fa-user text-primary"></i>
                                        Nama Lengkap
                                    </th>

                                    <td>
                                        {{ $data->name }}
                                    </td>

                                </tr>

                                <tr>

                                    <th>
                                        <i class="fas fa-user-tag text-info"></i>
                                        Username
                                    </th>

                                    <td>
                                        {{ $data->username }}
                                    </td>

                                </tr>

                                <tr>

                                    <th>
                                        <i class="fas fa-envelope text-danger"></i>
                                        Email
                                    </th>

                                    <td>
                                        {{ $data->email }}
                                    </td>

                                </tr>

                                <tr>

                                    <th>
                                        <i class="fas fa-shield-alt text-warning"></i>
                                        Role
                                    </th>

                                    <td>

                                        @if($data->role == 'owner')

                                        <span class="badge badge-danger">
                                            OWNER
                                        </span>

                                        @elseif($data->role == 'manager')

                                        <span class="badge badge-warning">
                                            MANAGER
                                        </span>

                                        @else

                                        <span class="badge badge-info">
                                            KASIR
                                        </span>

                                        @endif

                                    </td>

                                </tr>

                                <tr>

                                    <th>
                                        <i class="fas fa-toggle-on text-success"></i>
                                        Status
                                    </th>

                                    <td>

                                        @if($data->isactive == 1)

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

                                </tr>

                                <tr>

                                    <th>
                                        <i class="fas fa-calendar-plus text-primary"></i>
                                        Dibuat Pada
                                    </th>

                                    <td>

                                        {{ $data->created_at
                                            ? $data->created_at->format('d-m-Y H:i')
                                            : '-' }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>
                                        <i class="fas fa-edit text-warning"></i>
                                        Update Terakhir
                                    </th>

                                    <td>

                                        {{ $data->updated_at
                                            ? $data->updated_at->format('d-m-Y H:i')
                                            : '-' }}

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                        {{-- AKSI --}}
                        <div class="mt-4 d-flex gap-2">

                            {{-- EDIT --}}
                            <a href="{{ route('master.user.edit', $data->id) }}"
                                class="btn btn-warning">

                                <i class="fas fa-edit"></i>
                                Edit User

                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('master.user.destroy', $data->id) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-danger">

                                    <i class="fas fa-trash-alt"></i>
                                    Hapus User

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection