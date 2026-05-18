@extends('layouts.appadmin')



@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="mb-1">Data Kategori</h4>
            <p class="text-muted mb-0">
                Daftar semua kategori produk cafe
            </p>
        </div>

        <a href="{{ route('master.kategori.create') }}"
            class="btn btn-primary">
            + Tambah Kategori
        </a>

    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-hover align-middle">

                    <thead class="table-dark">

                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                            <th width="25%">Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse ($kategori as $item)

                            <tr>

                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $item->namakategori }}
                                </td>

                                <td>
                                    {{ $item->deskripsi }}
                                </td>

                                <td class="text-center">

                                    <a href="{{ route('master.kategori.show', $item->id) }}"
                                        class="btn btn-info btn-sm">
                                        Detail
                                    </a>

                                    <a href="{{ route('master.kategori.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('master.kategori.destroy', $item->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus data kategori?')">
                                            Hapus
                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center">
                                    Data kategori belum tersedia
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection