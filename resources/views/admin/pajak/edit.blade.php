@extends('layouts.appadmin')

@section('title', 'Edit Pajak')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4>Edit Pajak</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master.pajak.update', $data->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama Pajak</label>

                    <input type="text"
                           name="namapajak"
                           class="form-control"
                           value="{{ $data->namapajak }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>persentase Pajak</label>

                    <input type="number"
                           name="persentase"
                           class="form-control"
                           value="{{ $data->persentase }}"
                           required>
                </div>

                <div class="mb-3">
                    <label>Status</label>

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

                <button type="submit"
                        class="btn btn-primary">
                    Update
                </button>

                <a href="{{ route('master.pajak.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

@endsection