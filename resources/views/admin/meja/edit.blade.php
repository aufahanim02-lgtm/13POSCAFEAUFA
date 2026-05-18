@extends('layouts.appadmin')



@section('content')

<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0">Edit Meja</h1>
            <small class="text-muted">Ubah data meja</small>
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

                <form action="{{ route('master.meja.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group mb-3">
                        <label>Nomor Meja</label>
                        <input type="text" name="nomormeja" class="form-control"
                               value="{{ $data->nomormeja }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Kapasitas</label>
                        <input type="number" name="kapasitas" class="form-control"
                               value="{{ $data->kapasitas }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="kosong" {{ $data->status == 'kosong' ? 'selected' : '' }}>Kosong</option>
                            <option value="terisi" {{ $data->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
                        </select>
                    </div>

                    <button class="btn btn-success btn-sm">
                        <i class="fas fa-save"></i> Update
                    </button>

                </form>

            </div>
        </div>

    </div>
</section>

@endsection