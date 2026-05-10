@extends('layouts.appmanager')

@section('title', 'Edit Stok Masuk')

@section('content')

<div class="card">

    <div class="card-header">
        Edit Stok Masuk
    </div>

    <div class="card-body">

        <form action="{{ route('inventory.stokmasuk.update', $data->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">

                <label>Bahan Baku</label>

                <select name="bahanbakuid"
                        class="form-control">

                    @foreach($bahanbaku as $item)

                        <option value="{{ $item->id }}"
                            {{ $data->bahanbakuid == $item->id ? 'selected' : '' }}>

                            {{ $item->namabahan }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Jumlah</label>

                <input type="number"
                       name="jumlah"
                       value="{{ $data->jumlah }}"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Tanggal Masuk</label>

                <input type="date"
                       name="tanggalmasuk"
                       value="{{ $data->tanggalmasuk }}"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Keterangan</label>

                <textarea name="keterangan"
                          class="form-control">{{ $data->keterangan }}</textarea>

            </div>

            <button class="btn btn-success">
                Update
            </button>

        </form>

    </div>

</div>

@endsection