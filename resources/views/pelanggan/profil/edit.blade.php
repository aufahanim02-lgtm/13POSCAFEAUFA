@extends('layouts.apppelanggan')

@section('title', 'Edit Profil')

@section('content')
<div class="container py-4">

    <a href="{{ url('/pelanggan/profil') }}" class="btn btn-outline-secondary mb-4">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-white border-0 rounded-top-4">
            <h4 class="fw-bold mb-0">Edit Profil</h4>
        </div>

        <div class="card-body p-4">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ url('/pelanggan/profil/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-bold">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $pelanggan->name) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', $pelanggan->username) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $pelanggan->email) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">No HP</label>
                    <input type="text" name="nohp" class="form-control" value="{{ old('nohp', $pelanggan->nohp) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Foto Profil</label>
                    <input type="file" name="foto" class="form-control">
                    <small class="text-muted">Upload jpg/png max 2MB</small>
                </div>

                <hr>

                <div class="mb-3">
                    <label class="form-label fw-bold">Password Baru (Opsional)</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin mengganti">
                </div>

                <button type="submit" class="btn btn-success w-100">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>

            </form>

        </div>
    </div>

</div>
@endsection