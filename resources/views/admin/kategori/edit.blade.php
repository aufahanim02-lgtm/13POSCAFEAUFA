@extends('layouts.appadmin')

@section('title', 'Edit Kategori')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-warning">

            <h5 class="mb-0">
                Edit Kategori
            </h5>

        </div>

        <div class="card-body">

            <form action="{{ route('master.kategori.update', $kategori->id) }}"
                method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Nama Kategori
                    </label>

                    <input type="text"
                        name="namakategori"
                        class="form-control @error('namakategori') is-invalid @enderror"
                        value="{{ old('namakategori', $kategori->namakategori) }}">

                    @error('namakategori')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Deskripsi
                    </label>

                    <textarea name="deskripsi"
                        rows="5"
                        class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>

                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="d-flex gap-2">

                    <button type="submit"
                        class="btn btn-primary">
                        Update
                    </button>

                    <a href="{{ route('master.kategori.index') }}"
                        class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection