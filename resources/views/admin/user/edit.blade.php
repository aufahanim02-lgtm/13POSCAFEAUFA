@extends('layouts.appadmin')

@section('title', 'Edit User')

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Edit User</h3>
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

        <form action="{{ route('master.user.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name', $data->name) }}">
            </div>

            <div class="form-group mb-3">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required value="{{ old('username', $data->username) }}">
            </div>

            <div class="form-group mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email', $data->email) }}">
            </div>

            <div class="form-group mb-3">
                <label>Password (opsional)</label>
                <input type="password" name="password" class="form-control">
                <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
            </div>

            <div class="form-group mb-3">
                <label>Role</label>
                <select name="role" class="form-control" required>
                    <option value="owner" {{ $data->role == 'owner' ? 'selected' : '' }}>Owner</option>
                    <option value="manager" {{ $data->role == 'manager' ? 'selected' : '' }}>Manager</option>
                    <option value="kasir" {{ $data->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Status</label>
                <select name="isactive" class="form-control" required>
                    <option value="1" {{ $data->isactive == 1 ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ $data->isactive == 0 ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label>Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">

                @if($data->foto)
                    <div class="mt-2">
                        <small class="text-muted">Foto Saat Ini:</small><br>
                        <img src="{{ asset('storage/' . $data->foto) }}" width="80" class="rounded">
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('master.user.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>

                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save"></i> Update
                </button>
            </div>

        </form>

    </div>
</div>

@endsection