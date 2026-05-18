@extends('layouts.appadmin')



@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Tambah User</h3>
    </div>

    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <b>Terjadi Kesalahan:</b>
                <ul class="mb-0">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('master.user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            </div>

            <div class="form-group mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required value="{{ old('username') }}">
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            </div>

            <div class="form-group mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                <small class="text-muted">Minimal 6 karakter</small>
            </div>

            <div class="form-group mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="owner">Owner</option>
                    <option value="manager">Manager</option>
                    <option value="kasir">Kasir</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="isactive" class="form-control" required>
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('master.user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection