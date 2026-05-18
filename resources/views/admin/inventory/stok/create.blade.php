@extends('layouts.appadmin')



@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Tambah Stok</h4>
            <small class="text-muted">Input stok awal bahan baku</small>
        </div>

        <a href="{{ route('inventory.stok.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="{{ route('inventory.stok.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Bahan Baku ID</label>
                    <input type="number" name="bahanbakuid" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok Tersedia</label>
                    <input type="number" name="stoktersedia" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok Minimal</label>
                    <input type="number" name="stokminimal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-control">
                        <option value="Aman">Aman</option>
                        <option value="Menipis">Menipis</option>
                        <option value="Habis">Habis</option>
                    </select>
                </div>

                <button class="btn btn-primary btn-sm">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </form>

        </div>
    </div>

</div>
@endsection