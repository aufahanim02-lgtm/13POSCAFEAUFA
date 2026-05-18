@extends('layouts.appmanager')

@section('title', 'Tambah Laporan')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1 class="fw-bold">Tambah Laporan</h1>
            <small class="text-muted">Buat laporan baru</small>
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
                <div class="card-header bg-success text-white">
                    <h3 class="card-title">
                        <i class="fas fa-plus"></i> Form Tambah Laporan
                    </h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('laporan.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label>Jenis Laporan</label>
                            <input type="text" name="jenislaporan" class="form-control"
                                   placeholder="Contoh: Laporan Harian" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Periode Awal</label>
                            <input type="date" name="periodeawal" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>Periode Akhir</label>
                            <input type="date" name="periodeakhir" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <label>Total Data</label>
                            <input type="number" name="totaldata" class="form-control" value="0">
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan
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