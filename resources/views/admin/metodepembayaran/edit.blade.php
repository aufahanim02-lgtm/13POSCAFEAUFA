@extends('layouts.appadmin')

@section('title', 'Edit Metode Pembayaran')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Edit Metode Pembayaran</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master.metodepembayaran.update', $data->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-3">

                    <label class="form-label">
                        Nama Metode
                    </label>

                    <input type="text"
                        name="namametode"
                        class="form-control"
                        value="{{ old('namametode', $data->namametode) }}"
                        required>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Jenis
                    </label>

                    <select name="jenis"
                        class="form-control"
                        required>

                        <option value="">
                            -- Pilih Jenis --
                        </option>

                        <option value="cash"
                            {{ $data->jenis == 'cash' ? 'selected' : '' }}>
                            Cash
                        </option>

                        </option>

                        <option value="noncash"
                            {{ $data->jenis == 'noncash' ? 'selected' : '' }}>
                            Non Cash
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                        class="form-control"
                        required>

                        <option value="aktif"
                            {{ $data->status == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif"
                            {{ $data->status == 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>

                    </select>

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        QR Code
                    </label>

                    @if($data->qrcode)

                    <div class="mb-2">

                        <img src="{{ asset('storage/' . $data->qrcode) }}"
                            width="150"
                            class="img-thumbnail">

                    </div>

                    @endif

                    <input type="file"
                        name="qrcode"
                        class="form-control">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti QR Code
                    </small>

                </div>

                <button type="submit"
                    class="btn btn-primary">

                    Update

                </button>

                <a href="{{ route('master.metodepembayaran.index') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection