@extends('layouts.appmanager')

@section('title', 'Edit Stok')

@section('content')

<div class="card">

    <div class="card-header">
        Edit Stok
    </div>

    <div class="card-body">

        <form action="{{ route('inventory.stok.update', $data->id) }}"
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

                <label>Stok Tersedia</label>

                <input type="number"
                       name="stoktersedia"
                       value="{{ $data->stoktersedia }}"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Stok Minimal</label>

                <input type="number"
                       name="stokminimal"
                       value="{{ $data->stokminimal }}"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="aman"
                        {{ $data->status == 'aman' ? 'selected' : '' }}>
                        Aman
                    </option>

                    <option value="menipis"
                        {{ $data->status == 'menipis' ? 'selected' : '' }}>
                        Menipis
                    </option>

                </select>

            </div>

            <button class="btn btn-success">
                Update
            </button>

        </form>

    </div>

</div>

@endsection