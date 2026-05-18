@extends('layouts.appadmin')



@section('content')

<div class="card">

    <div class="card-header">
        Tambah Stok Keluar
    </div>

    <div class="card-body">

        <form action="{{ route('inventory.stokkeluar.store') }}"
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

                <label>Tanggal Keluar</label>

                <input type="date"
                    name="tanggalkeluar"
                    class="form-control">

            </div>

            <div class="mb-3">

                <label>Alasan</label>

                <textarea name="alasan"
                    class="form-control"></textarea>

            </div>

            <button class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>
    <a href="{{ route('inventory.stokkeluar.index') }}"
        class="btn btn-secondary">
        Kembali
    </a>
</div>

@endsection