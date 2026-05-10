@extends('layouts.appmanager')

@section('title', 'Tambah Stok Masuk')

@section('content')

<div class="card">

    <div class="card-header">
        Tambah Stok Masuk
    </div>

    <div class="card-body">

        <form action="{{ route('inventory.stokmasuk.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label>Bahan Baku</label>

                <select name="bahanbakuid"
                        class="form-control">

                    @foreach($bahanbaku as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->namabahan }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Jumlah</label>

                <input type="number"
                       name="jumlah"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Tanggal Masuk</label>

                <input type="date"
                       name="tanggalmasuk"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Keterangan</label>

                <textarea name="keterangan"
                          class="form-control"></textarea>

            </div>

            <button class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>

</div>

@endsection