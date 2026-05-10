@extends('layouts.appmanager')

@section('title', 'Edit Bahan Baku')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Edit Bahan Baku
        </h3>

    </div>

    <form action="{{ route('inventory.bahanbaku.update', $data->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="form-group mb-3">

                <label>Kode Bahan</label>

                <input type="text"
                       name="kodebahan"
                       value="{{ $data->kodebahan }}"
                       class="form-control"
                       required>

            </div>

            <div class="form-group mb-3">

                <label>Nama Bahan</label>

                <input type="text"
                       name="namabahan"
                       value="{{ $data->namabahan }}"
                       class="form-control"
                       required>

            </div>

            <div class="form-group mb-3">

                <label>Stok</label>

                <input type="number"
                       name="stok"
                       value="{{ $data->stok }}"
                       class="form-control"
                       required>

            </div>

            <div class="form-group mb-3">

                <label>Satuan</label>

                <input type="text"
                       name="satuan"
                       value="{{ $data->satuan }}"
                       class="form-control">

            </div>

            <div class="form-group mb-3">

                <label>Harga Beli</label>

                <input type="number"
                       name="hargabeli"
                       value="{{ $data->hargabeli }}"
                       class="form-control"
                       required>

            </div>

        </div>

        <div class="card-footer">

            <button type="submit"
                    class="btn btn-success">

                <i class="fas fa-save"></i>
                Update

            </button>

            <a href="{{ route('inventory.bahanbaku.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </form>

</div>

@endsection