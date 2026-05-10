@extends('layouts.appmanager')

@section('title', 'Tambah Stok')

@section('content')

<div class="card">

    <div class="card-header">
        Tambah Stok
    </div>

    <div class="card-body">

        <form action="{{ route('inventory.stok.store') }}"
              method="POST">

            @csrf

            <div class="mb-3">

                <label>Bahan Baku</label>

                <select name="bahanbakuid"
                        class="form-control">

                    @foreach($bahanbaku as $item)

                        <option value="{{ $item->id }}">
                            {{ $item->namabahan }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-3">

                <label>Stok Tersedia</label>

                <input type="number"
                       name="stoktersedia"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Stok Minimal</label>

                <input type="number"
                       name="stokminimal"
                       class="form-control">

            </div>

            <div class="mb-3">

                <label>Status</label>

                <select name="status"
                        class="form-control">

                    <option value="aman">Aman</option>
                    <option value="menipis">Menipis</option>

                </select>

            </div>

            <button class="btn btn-primary">
                Simpan
            </button>

        </form>

    </div>

</div>

@endsection