@extends('layouts.appadmin')


@section('content')

<section class="content">

    <div class="container-fluid">

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show">

                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

                {{ session('success') }}

            </div>

        @endif

        {{-- ERROR MESSAGE --}}
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show">

                <button type="button"
                        class="close"
                        data-dismiss="alert"
                        aria-label="Close">

                    <span aria-hidden="true">&times;</span>

                </button>

                {{ session('error') }}

            </div>

        @endif

        <div class="card shadow-sm">

            <div class="card-header bg-dark text-white">

                <h3 class="card-title">

                    <i class="fas fa-history"></i>
                    Login History

                </h3>

            </div>

            <div class="card-body table-responsive p-0">

                <table class="table table-bordered table-hover table-striped mb-0">

                    <thead class="bg-primary text-white">

                        <tr class="text-center">

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

                                {{-- NO --}}
                                <td class="text-center align-middle">
                                    {{ $no + 1 }}
                                </td>

                                {{-- USER --}}
                                <td class="align-middle">

                                    <div class="font-weight-bold">

                                        {{ $row->user->name ?? '-' }}

                                    </div>

                                </td>

                                {{-- IP --}}
                                <td class="align-middle">

                                    <span class="text-muted">
                                        {{ $row->ipaddress }}
                                    </span>

                                </td>

                                {{-- STATUS --}}
                                <td class="text-center align-middle">

                                    @if($row->status == 'success')

                                        <span class="badge badge-success px-3 py-2">
                                            SUCCESS
                                        </span>

                                    @elseif($row->status == 'failed')

                                        <span class="badge badge-danger px-3 py-2">
                                            FAILED
                                        </span>

                                    @else

                                        <span class="badge badge-secondary px-3 py-2">
                                            {{ strtoupper($row->status) }}
                                        </span>

                                    @endif

                                </td>

                                {{-- LOGIN --}}
                                <td class="align-middle">

                                    @if($row->loginat)

                                        <span class="text-success font-weight-bold">

                                            {{ date('d-m-Y H:i:s', strtotime($row->loginat)) }}

                                        </span>

                                    @else

                                        -

                                    @endif

                                </td>

                                {{-- LOGOUT --}}
                                <td class="align-middle">

                                    @if($row->logoutat)

                                        <span class="text-danger font-weight-bold">

                                            {{ date('d-m-Y H:i:s', strtotime($row->logoutat)) }}

                                        </span>

                                    @else

                                        <span class="badge badge-warning">
                                            Masih Login
                                        </span>

                                    @endif

                                </td>

                                {{-- AKSI --}}
                                <td class="text-center align-middle">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('loginhistory.show', $row->id) }}"
                                       class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('loginhistory.destroy', $row->id) }}"
                                          method="POST"
                                          class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus history ini?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center text-muted py-4">

                                    <i class="fas fa-folder-open fa-2x mb-2"></i>

                                    <br>

                                    Data login history kosong

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</section>

@endsection