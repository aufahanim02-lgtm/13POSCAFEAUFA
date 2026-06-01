@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4>Tambah Produk</h4>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('master.produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategoriid" class="form-control" required>

                        <option value="">
                            -- Pilih Kategori --
                        </option>

                        @foreach($kategori as $item)

                            <option value="{{ $item->id }}">
                                {{ $item->namakategori }}
                            </option>

                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label>Kode Produk</label>

                    <input type="text"
                           name="kodeproduk"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Nama Produk</label>

                    <input type="text"
                           name="namaproduk"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>

                    <textarea name="deskripsi"
                              class="form-control"
                              rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label>Harga Jual</label>

                    <input type="number"
                           name="hargajual"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Stok</label>

                    <input type="number"
                           name="stok"
                           value="0"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Stok Produk</label>

                    <input type="number"
                           name="stokproduk"
                           value="0"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Satuan</label>

                    <input type="text"
                           name="satuan"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Foto Produk</label>

                    <input type="file"
                           name="foto"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status"
                            class="form-control"
                            required>

                        <option value="aktif">
                            Aktif
                        </option>

                        <option value="nonaktif">
                            Nonaktif
                        </option>

                    </select>
                </div>

                <button type="submit"
                        class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('master.produk.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection