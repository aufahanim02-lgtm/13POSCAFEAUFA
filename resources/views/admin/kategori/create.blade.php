@extends('layouts.appadmin')


@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-primary text-white">

            <h5 class="mb-0">
                Tambah Kategori
            </h5>

        </div>

        <div class="card-body">

            <form action="{{ route('master.kategori.store') }}"
                method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">
                        Nama Kategori
                    </label>

                    <input type="text"
                        name="namakategori"
                        class="form-control @error('namakategori') is-invalid @enderror"
                        value="{{ old('namakategori') }}"
                        placeholder="Masukkan nama kategori">

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
                        class="form-control @error('deskripsi') is-invalid @enderror"
                        placeholder="Masukkan deskripsi kategori">{{ old('deskripsi') }}</textarea>

                    @error('deskripsi')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="d-flex gap-2">

                    <button type="submit"
                        class="btn btn-success">
                        Simpan
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