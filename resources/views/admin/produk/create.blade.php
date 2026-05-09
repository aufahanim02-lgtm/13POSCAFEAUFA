@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Tambah Produk</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master.produk.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">
                    <label>Kategori</label>

                    <select name="kategoriid" class="form-control">

                        <option value="">-- Pilih Kategori --</option>

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
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Nama Produk</label>

                    <input type="text"
                           name="namaproduk"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Harga Jual</label>

                    <input type="number"
                           name="hargajual"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Satuan</label>

                    <input type="text"
                           name="satuan"
                           class="form-control">
                </div>

                <button class="btn btn-primary">
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