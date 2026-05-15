@extends('layouts.appadmin')

@section('title', 'Resep Produk')

@section('content')
<div class="container-fluid">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">📌 Daftar Produk - Resep</h5>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produk as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->kodeproduk }}</td>
                            <td>{{ $item->namaproduk }}</td>
                            <td>{{ $item->kategori->namakategori ?? '-' }}</td>
                            <td>
                                <a href="{{ route('master.resep.show', $item->id) }}"
                                   class="btn btn-primary btn-sm">
                                    🔧 Atur Resep
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Produk belum tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection