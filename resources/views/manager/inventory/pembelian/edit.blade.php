@extends('layouts.appmanager')

@section('title', 'Edit Pembelian')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Edit Pembelian
        </h3>

    </div>

    <form action="{{ route('inventory.pembelian.update',$pembelian->id) }}"
        method="POST">

        @csrf
        @method('PUT')

        <div class="card-body">

            <div class="form-group mb-3">

                <label>Supplier</label>

                <select name="supplierid"
                    class="form-control">

                    @foreach($supplier as $s)

                        <option value="{{ $s->id }}"
                            {{ $pembelian->supplierid == $s->id ? 'selected' : '' }}>

                            {{ $s->namasupplier }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="form-group mb-3">

                <label>Tanggal Pembelian</label>

                <input type="date"
                    name="tanggalpembelian"
                    value="{{ $pembelian->tanggalpembelian }}"
                    class="form-control">

            </div>

            <div class="form-group mb-3">

                <label>Total</label>

                <input type="number"
                    name="total"
                    value="{{ $pembelian->total }}"
                    class="form-control">

            </div>

        </div>

        <div class="card-footer">

            <button class="btn btn-primary">

                Update

            </button>

        </div>

    </form>

</div>

@endsection