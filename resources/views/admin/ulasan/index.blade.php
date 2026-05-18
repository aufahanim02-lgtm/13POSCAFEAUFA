@extends('layouts.appadmin')

@section('content')

<div class="container-fluid py-3">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="badge badge-primary px-3 py-2">
            OWNER PANEL
        </span>

    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">

            <i class="fas fa-check-circle"></i>
            {{ session('success') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">

            <i class="fas fa-times-circle"></i>
            {{ session('error') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">

                <span aria-hidden="true">&times;</span>

            </button>

        </div>
    @endif

    {{-- SEARCH --}}
    <div class="card shadow-sm border-0 mb-3">

        <div class="card-body">

            <form method="GET" action="{{ route('admin.ulasan.index') }}">

                <div class="row">

                    <div class="col-md-10 mb-2 mb-md-0">

                        <div class="input-group">

                            <input type="text"
                                   name="search"
                                   value="{{ request('search') }}"
                                   class="form-control"
                                   placeholder="Cari nama produk...">

                            <div class="input-group-append">
                                <button class="btn btn-primary">

                                    <i class="fas fa-search"></i>
                                    Cari

                                </button>
                            </div>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm border-0">

        <div class="card-header bg-white">

            <h5 class="mb-0 fw-bold">
                <i class="fas fa-comments text-info"></i>
                Daftar Ulasan
            </h5>

        </div>

        <div class="card-body">

            @if($data->count() == 0)

                <div class="alert alert-warning mb-0">

                    <i class="fas fa-exclamation-circle"></i>
                    Belum ada ulasan dari pelanggan.

                </div>

            @else

                <div class="table-responsive">

                    <table class="table table-bordered table-hover align-middle">

                        <thead class="thead-dark text-center">

                            <tr>
                                <th width="5%">#</th>
                                <th>Invoice</th>
                                <th>Pelanggan</th>
                                <th>Produk</th>
                                <th width="10%">Rating</th>
                                <th>Komentar</th>
                                <th width="15%">Tanggal</th>
                                <th width="15%">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($data as $item)

                                <tr>

                                    {{-- NO --}}
                                    <td class="text-center">
                                        {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                                    </td>

                                    {{-- INVOICE --}}
                                    <td>
                                        {{ $item->penjualan->kodeinvoice ?? '-' }}
                                    </td>

                                    {{-- PELANGGAN --}}
                                    <td>
                                        {{ $item->pelanggan->name ?? 'Tidak diketahui' }}
                                    </td>

                                    {{-- PRODUK --}}
                                    <td>

                                        <span>
                                            {{ $item->produk->namaproduk ?? '-' }}
                                        </span>

                                    </td>

                                    {{-- RATING --}}
                                    <td class="text-center">

                                        <span>
                                            ⭐ {{ $item->rating }}/5
                                        </span>

                                    </td>

                                    {{-- KOMENTAR --}}
                                    <td>

                                        {{ $item->komentar ?? '-' }}

                                    </td>

                                    {{-- TANGGAL --}}
                                    <td class="text-center">

                                        {{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y H:i') : '-' }}

                                    </td>

                                    {{-- AKSI --}}
                                    <td class="text-center">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('admin.ulasan.show', $item->id) }}"
                                           class="btn btn-info btn-sm"
                                           title="Detail">

                                            <i class="fas fa-eye"></i>

                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('admin.ulasan.destroy', $item->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                    title="Hapus">

                                                <i class="fas fa-trash-alt"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                <div class="mt-3 d-flex justify-content-end">

                    {{ $data->links() }}

                </div>

            @endif

        </div>

    </div>

</div>

@endsection