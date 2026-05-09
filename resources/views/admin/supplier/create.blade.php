@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Tambah Supplier</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master.supplier.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">
                    <label>Nama Supplier</label>

                    <input type="text"
                           name="namasupplier"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>No HP</label>

                    <input type="text"
                           name="nohp"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>

                    <textarea name="alamat"
                              class="form-control"
                              rows="4"></textarea>
                </div>

                <button type="submit"
                        class="btn btn-primary">

                    Simpan

                </button>

                <a href="{{ route('master.supplier.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection