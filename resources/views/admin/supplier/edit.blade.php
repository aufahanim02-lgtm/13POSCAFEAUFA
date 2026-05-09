@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Edit Supplier</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master.supplier.update', $data->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Supplier</label>

                    <input type="text"
                           name="namasupplier"
                           class="form-control"
                           value="{{ $data->namasupplier }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>No HP</label>

                    <input type="text"
                           name="nohp"
                           class="form-control"
                           value="{{ $data->nohp }}">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>

                    <textarea name="alamat"
                              class="form-control"
                              rows="4">{{ $data->alamat }}</textarea>
                </div>

                <button type="submit"
                        class="btn btn-primary">

                    Update

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