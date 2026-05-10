@extends('layouts.appmanager')

@section('title', 'Tambah Bahan Baku')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Tambah Bahan Baku
        </h3>

    </div>

    <form action="{{ route('inventory.bahanbaku.store') }}"
          method="POST">

        @csrf

        <div class="card-body">

            <div class="form-group mb-3">

                <label>Kode Bahan</label>

                <input type="text"
                       name="kodebahan"
                       class="form-control"
                       required>

            </div>

            <div class="form-group mb-3">

                <label>Nama Bahan</label>

                <input type="text"
                       name="namabahan"
                       class="form-control"
                       required>

            </div>

            <div class="form-group mb-3">

                <label>Stok</label>

                <input type="number"
                       name="stok"
                       class="form-control"
                       required>

            </div>

            <div class="form-group mb-3">

                <label>Satuan</label>

                <input type="text"
                       name="satuan"
                       class="form-control">

            </div>

            <div class="form-group mb-3">

                <label>Harga Beli</label>

                <input type="number"
                       name="hargabeli"
                       class="form-control"
                       required>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-primary">

                <i class="fas fa-save"></i>
                Simpan

            </button>

            <a href="{{ route('inventory.bahanbaku.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection