@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Edit Produk</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master.produk.update', $data->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Kategori</label>

                    <select name="kategoriid" class="form-control">

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
                           value="{{ $data->kodeproduk }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Nama Produk</label>

                    <input type="text"
                           name="namaproduk"
                           value="{{ $data->namaproduk }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Harga Jual</label>

                    <input type="number"
                           name="hargajual"
                           value="{{ $data->hargajual }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Satuan</label>

                    <input type="text"
                           name="satuan"
                           value="{{ $data->satuan }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control">

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

                <button class="btn btn-primary">
                    Update
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