@extends('layouts.appadmin')


@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Edit Promo</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master.promo.update', $data->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                {{-- NAMA PROMO --}}
                <div class="mb-3">
                    <label>Nama Promo</label>
                    <input type="text"
                           name="namapromo"
                           value="{{ $data->namapromo }}"
                           class="form-control"
                           required>
                </div>

                {{-- JENIS --}}
                <div class="mb-3">
                    <label>Jenis Promo</label>

                    <select name="jenis" class="form-control" required>
                        <option value="persen" {{ $data->jenis == 'persen' ? 'selected' : '' }}>
                            Persen
                        </option>

                        <option value="nominal" {{ $data->jenis == 'nominal' ? 'selected' : '' }}>
                            Nominal
                        </option>
                    </select>
                </div>

                {{-- NILAI DISKON --}}
                <div class="mb-3">
                    <label>Nilai Diskon</label>
                    <input type="number"
                           name="nilaidiskon"
                           value="{{ $data->nilaidiskon }}"
                           class="form-control"
                           required>
                </div>

                {{-- MINIMAL BELANJA --}}
                <div class="mb-3">
                    <label>Minimal Belanja</label>
                    <input type="number"
                           name="minimalbelanja"
                           value="{{ $data->minimalbelanja }}"
                           class="form-control">
                </div>

                {{-- TANGGAL MULAI --}}
                <div class="mb-3">
                    <label>Tanggal Mulai</label>
                    <input type="date"
                           name="tanggalmulai"
                           value="{{ $data->tanggalmulai }}"
                           class="form-control"
                           required>
                </div>

                {{-- TANGGAL SELESAI --}}
                <div class="mb-3">
                    <label>Tanggal Selesai</label>
                    <input type="date"
                           name="tanggalselesai"
                           value="{{ $data->tanggalselesai }}"
                           class="form-control"
                           required>
                </div>

                {{-- STATUS --}}
                <div class="mb-3">
                    <label>Status</label>

                    <select name="status" class="form-control" required>
                        <option value="aktif" {{ $data->status == 'aktif' ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="nonaktif" {{ $data->status == 'nonaktif' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>
                </div>

                <button class="btn btn-primary">
                    Update
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