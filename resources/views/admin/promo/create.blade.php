@extends('layouts.appadmin')

@section('title', 'Tambah Promo')

@section('content')

<div class="container-fluid">

    <div class="card">
        <div class="card-header">
            <h4>Tambah Promo</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master.promo.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">
                    <label>Kode Promo</label>
                    <input type="text"
                           name="kodepromo"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Nama Promo</label>
                    <input type="text"
                           name="namapromo"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Jenis Promo</label>

                    <select name="jenis"
                            class="form-control">

                        <option value="persen">
                            Persen
                        </option>

                        <option value="nominal">
                            Nominal
                        </option>

                    </select>
                </div>

                <div class="mb-3">
                    <label>Nilai Diskon</label>
                    <input type="number"
                           name="nilaidiskon"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Minimal Belanja</label>
                    <input type="number"
                           name="minimalbelanja"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date"
                           name="tanggalmulai"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Tanggal Selesai</label>
                    <input type="date"
                           name="tanggalselesai"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Status</label>

                    <select name="status"
                            class="form-control">

                        <option value="aktif">
                            Aktif
                        </option>

                        <option value="nonaktif">
                            Nonaktif
                        </option>

                    </select>
                </div>

                <button class="btn btn-primary">
                    Simpan
                </button>

                <a href="{{ route('master.promo.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>

@endsection