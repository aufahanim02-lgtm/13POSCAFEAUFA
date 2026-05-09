@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Produk</h4>

        
        <a href="{{ route('master.produk.create') }}" class="btn btn-primary">
            + Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Foto</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Jual</th>
                        <th>Satuan</th>
                        <th>Status</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $item)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}"
                                     width="70">
                            @else
                                <span class="text-muted">Tidak ada foto</span>
                            @endif
                        </td>

                        <td>{{ $item->kodeproduk }}</td>

                        <td>{{ $item->namaproduk }}</td>

                        <td>
                            {{ $item->kategori->namakategori ?? '-' }}
                        </td>

                        <td>
                            Rp {{ number_format($item->hargajual,0,',','.') }}
                        </td>

                        <td>{{ $item->satuan }}</td>

                        <td>
                            @if($item->status == 'aktif')
                                <span class="badge bg-success">
                                    Aktif
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    Nonaktif
                                </span>
                            @endif
                        </td>

                        <td>

                            <a href="{{ route('master.produk.edit', $item->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('master.produk.destroy', $item->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus produk?')">
                                    Hapus
                                </button>

                            </form>

                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="9" class="text-center">
                            Data produk kosong
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection