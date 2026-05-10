@extends('layouts.appmanager')

@section('title', 'Tambah Pembelian')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Tambah Pembelian
        </h3>

    </div>

    <form action="{{ route('inventory.pembelian.store') }}"
        method="POST">

        @csrf

        <div class="card-body">

            <div class="form-group mb-3">

                <label>Supplier</label>

                <select name="supplierid"
                    class="form-control"
                    required>

                    <option value="">
                        -- Pilih Supplier --
                    </option>

                    @foreach($supplier as $s)

                        <option value="{{ $s->id }}">
                            {{ $s->namasupplier }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group mb-3">

                <label>Tanggal Pembelian</label>

                <input type="date"
                    name="tanggalpembelian"
                    class="form-control"
                    required>

            </div>

            <div class="form-group mb-3">

                <label>Total</label>

                <input type="number"
                    name="total"
                    class="form-control"
                    required>

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-success">

                Simpan

            </button>

        </div>

    </form>

</div>

@endsection