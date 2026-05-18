@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h3 class="card-title fw-bold mb-0">
                    <i class="fas fa-plus-circle text-primary"></i>
                    Tambah Bahan Baku
                </h3>

                <small class="text-muted">
                    Tambahkan data bahan baku baru
                </small>
            </div>

            <a href="{{ route('inventory.bahanbaku.index') }}"
               class="btn btn-secondary btn-sm">

                <i class="fas fa-arrow-left"></i>
                Kembali

            </a>

        </div>

        <div class="card-body">

            <form action="{{ route('inventory.bahanbaku.store') }}"
                  method="POST">

                @csrf

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode Bahan</label>
                            <input type="text" name="kodebahan" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Bahan</label>
                            <input type="text" name="namabahan" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Stok</label>
                            <input type="number" step="0.01" name="stok" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Satuan</label>
                            <input type="text" name="satuan" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Harga Beli</label>
                            <input type="number" step="0.01" name="hargabeli" class="form-control" required>
                        </div>
                    </div>

                </div>

                <hr>

                <button class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>

            </form>

        </div>

    </div>

</div>

@endsection