@extends('layouts.appadmin')

@section('title', 'Detail Resep Produk')

@section('content')
<div class="container-fluid">

    <a href="{{ route('master.resep.index') }}" class="btn btn-secondary mb-3">
        ⬅ Kembali
    </a>

    <div class="card shadow-sm mb-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">🍽 Resep Produk: {{ $produk->namaproduk }}</h5>
        </div>
        <div class="card-body">
            <p><b>Kode Produk:</b> {{ $produk->kodeproduk }}</p>
            <p><b>Kategori:</b> {{ $produk->kategori->namakategori ?? '-' }}</p>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- FORM TAMBAH RESEP --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-dark text-white">
            <h6 class="mb-0">➕ Tambah Resep</h6>
        </div>
        <div class="card-body">

            <form method="POST" action="{{ route('master.resep.store', $produk->id) }}">
                @csrf

                <div class="row">

                    <div class="col-md-5 mb-3">
                        <label class="form-label">Bahan Baku</label>
                        <select name="bahanbakuid" class="form-control" required>
                            <option value="">-- pilih bahan baku --</option>
                            @foreach($bahanbaku as $bb)
                                <option value="{{ $bb->id }}">
                                    {{ $bb->namabahan }} (stok: {{ $bb->stok }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Jumlah Pemakaian</label>
                        <input type="number" name="jumlah" class="form-control" min="1" required>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Satuan</label>
                        <input type="text" name="satuan" class="form-control" placeholder="gram/ml/pcs">
                    </div>

                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button class="btn btn-success w-100">
                            Simpan
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- LIST RESEP --}}
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h6 class="mb-0">📋 Daftar Resep Produk</h6>
        </div>
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="50">No</th>
                        <th>Bahan Baku</th>
                        <th>Jumlah</th>
                        <th>Satuan</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($resep as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->bahanbaku->namabahan ?? '-' }}</td>
                            <td>{{ $item->jumlah }}</td>
                            <td>{{ $item->satuan ?? '-' }}</td>
                            <td class="d-flex gap-2">

                                <a href="{{ route('master.resep.edit', $item->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form method="POST" action="{{ route('master.resep.destroy', $item->id) }}"
                                      onsubmit="return confirm('Hapus resep ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Resep belum dibuat untuk produk ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection