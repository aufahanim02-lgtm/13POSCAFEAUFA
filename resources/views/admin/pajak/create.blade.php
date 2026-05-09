@extends('layouts.appadmin')

@section('title', 'Tambah Pajak')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4>Tambah Pajak</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master.pajak.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">
                    <label>Nama Pajak</label>

                    <input type="text"
                           name="namapajak"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Persen Pajak</label>

                    <input type="number"
                           name="persen"
                           class="form-control"
                           required>
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status"
                            class="form-control"
                            required>

                        <option value="">-- Pilih Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>

                    </select>
                </div>

                <button type="submit"
                        class="btn btn-success">
                    Simpan
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