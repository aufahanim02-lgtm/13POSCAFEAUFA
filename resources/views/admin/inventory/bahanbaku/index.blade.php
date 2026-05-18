@extends('layouts.appadmin')

@section('content')

<div class="card shadow-sm">

    {{-- HEADER --}}
    <div class="card-header d-flex justify-content-between align-items-center">

        <div>
            <h3 class="card-title mb-0 fw-bold">
                <i class="fas fa-boxes text-primary"></i>
                Data Bahan Baku
            </h3>

            <small class="text-muted">
                Daftar seluruh bahan baku inventory
            </small>
        </div>

        {{-- BUTTON TAMBAH --}}
        <a href="{{ route('inventory.bahanbaku.create') }}"
           class="btn btn-primary btn-sm">

            <i class="fas fa-plus"></i>
            Tambah

        </a>

    </div>

    {{-- BODY --}}
    <div class="card-body">

        {{-- ALERT SUCCESS --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">

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

        {{-- TABLE --}}
        <div class="table-responsive">

            <table class="table table-bordered table-striped table-hover align-middle">

                <thead class="thead-dark text-center">

                    <tr>
                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama Bahan</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th width="18%">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($data as $no => $row)

                        <tr>

                            {{-- NO --}}
                            <td class="text-center">
                                {{ $no + 1 }}
                            </td>

                            {{-- KODE --}}
                            <td class="fw-bold text-primary">
                                {{ $row->kodebahan }}
                            </td>

                            {{-- NAMA --}}
                            <td>
                                {{ $row->namabahan }}
                            </td>

                            {{-- STOK --}}
                            <td class="text-center">
                                {{ $row->stok }}
                            </td>

                            {{-- SATUAN --}}
                            <td class="text-center">
                                {{ $row->satuan }}
                            </td>

                            {{-- HARGA --}}
                            <td class="fw-bold text-success">
                                Rp {{ number_format($row->hargabeli, 0, ',', '.') }}
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">

                                {{-- DETAIL --}}
                                <a href="{{ route('inventory.bahanbaku.show', $row->id) }}"
                                   class="btn btn-info btn-sm"
                                   title="Detail">

                                    <i class="fas fa-eye"></i>

                                </a>

                                {{-- EDIT --}}
                                <a href="{{ route('inventory.bahanbaku.edit', $row->id) }}"
                                   class="btn btn-warning btn-sm"
                                   title="Edit">

                                    <i class="fas fa-edit"></i>

                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('inventory.bahanbaku.destroy', $row->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus data ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-danger btn-sm"
                                            title="Hapus">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="text-center text-muted py-4">

                                <i class="fas fa-info-circle"></i>
                                Data bahan baku belum tersedia.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection