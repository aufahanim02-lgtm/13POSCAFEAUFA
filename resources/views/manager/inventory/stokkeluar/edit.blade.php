@extends('layouts.appmanager')

@section('title', 'Edit Stok Keluar')

@section('content')

<div class="card">

    <div class="card-header">
        Edit Stok Keluar
    </div>

    <div class="card-body">

        <form action="{{ route('inventory.stokkeluar.update', $data->id) }}"
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

                <label>Tanggal Keluar</label>

                <input type="date"
                       name="tanggalkeluar"
                       value="{{ $data->tanggalkeluar }}"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Alasan</label>

                <textarea name="alasan"
                          class="form-control">{{ $data->alasan }}</textarea>

            </div>

            <button class="btn btn-success">
                Update
            </button>

        </form>

    </div>

</div>

@endsection