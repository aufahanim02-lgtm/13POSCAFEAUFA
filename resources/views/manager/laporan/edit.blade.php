@extends('layouts.appmanager')

@section('title', 'Edit Laporan')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1 class="fw-bold">Edit Laporan</h1>
            <small class="text-muted">Perbarui data laporan</small>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i> Form Edit Laporan
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('laporan.update', $data->id) }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Jenis Laporan</label>
                            <input type="text" name="jenislaporan" class="form-control"
                                   value="{{ $data->jenislaporan }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Periode Awal</label>
                            <input type="date" name="periodeawal" class="form-control"
                                   value="{{ $data->periodeawal }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Periode Akhir</label>
                            <input type="date" name="periodeakhir" class="form-control"
                                   value="{{ $data->periodeakhir }}">
                        </div>

                        <div class="form-group mb-3">
                            <label>Total Data</label>
                            <input type="number" name="totaldata" class="form-control"
                                   value="{{ $data->totaldata }}">
                        </div>

                        <button type="submit" class="btn btn-warning text-white">
                            <i class="fas fa-save"></i> Update
                        </button>

                        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                    </form>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection