@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4>Edit Produk</h4>
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

            <form action="{{ route('master.produk.update', $data->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Kategori</label>

                    <select name="kategoriid" class="form-control" required>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}"
                                {{ $data->kategoriid == $item->id ? 'selected' : '' }}>
                                {{ $item->namakategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Kode Produk</label>

                    <input type="text"
                           name="kodeproduk"
                           value="{{ old('kodeproduk', $data->kodeproduk) }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Nama Produk</label>

                    <input type="text"
                           name="namaproduk"
                           value="{{ old('namaproduk', $data->namaproduk) }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>

                    <textarea name="deskripsi"
                              rows="4"
                              class="form-control">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                </div>

                <div class="mb-3">
                    <label>Harga Jual</label>

                    <input type="number"
                           name="hargajual"
                           value="{{ old('hargajual', $data->hargajual) }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Stok</label>

                    <input type="number"
                           name="stok"
                           value="{{ old('stok', $data->stok) }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Stok Produk</label>

                    <input type="number"
                           name="stokproduk"
                           value="{{ old('stokproduk', $data->stokproduk) }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Satuan</label>

                    <input type="text"
                           name="satuan"
                           value="{{ old('satuan', $data->satuan) }}"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Foto Produk</label>

                    <input type="file"
                           name="foto"
                           class="form-control">

                    @if($data->foto)
                        <div class="mt-3">
                            <p class="text-muted mb-1">
                                Foto Saat Ini
                            </p>

                            <img src="{{ asset('storage/'.$data->foto) }}"
                                 width="150"
                                 class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status"
                            class="form-control"
                            required>

                        <option value="aktif"
                            {{ $data->status == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif"
                            {{ $data->status == 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>
                </div>

                <button type="submit"
                        class="btn btn-primary">
                    Update Produk
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