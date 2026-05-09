@extends('layouts.appadmin')

@section('title', 'Tambah Meja')

@section('content')

<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0">Tambah Meja</h1>
            <small class="text-muted">Form input meja baru</small>
        </div>

        <a href="{{ route('master.meja.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card shadow-sm">
            <div class="card-body">

                <form action="{{ route('master.meja.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label>Nomor Meja</label>
                        <input type="text" name="nomormeja" class="form-control" placeholder="Contoh: Meja 01" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Kapasitas</label>
                        <input type="number" name="kapasitas" class="form-control" placeholder="Contoh: 4" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="kosong">Kosong</option>
                            <option value="terisi">Terisi</option>
                        </select>
                    </div>

                    <button class="btn btn-success btn-sm">
                        <i class="fas fa-save"></i> Simpan
                    </button>

                </form>

            </div>
        </div>

    </div>
</section>

@endsection