@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card shadow-sm">

        {{-- HEADER --}}
        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h3 class="card-title mb-0 fw-bold">
                    <i class="fas fa-edit text-warning"></i>
                    Edit Bahan Baku
                </h3>

                <small class="text-muted">
                    Update data bahan baku inventory
                </small>
            </div>

            <a href="{{ route('inventory.bahanbaku.index') }}"
               class="btn btn-secondary btn-sm">

                <i class="fas fa-arrow-left"></i>
                Kembali

            </a>

        </div>

        {{-- BODY --}}
        <div class="card-body">

            @if ($errors->any())

                <div class="alert alert-danger">

                    <ul class="mb-0">

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form action="{{ route('inventory.bahanbaku.update', $data->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    {{-- KODE --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Kode Bahan</label>

                            <input type="text"
                                   name="kodebahan"
                                   class="form-control"
                                   value="{{ old('kodebahan', $data->kodebahan) }}"
                                   required>

                        </div>

                    </div>

                    {{-- NAMA --}}
                    <div class="col-md-6">

                        <div class="form-group">

                            <label>Nama Bahan</label>

                            <input type="text"
                                   name="namabahan"
                                   class="form-control"
                                   value="{{ old('namabahan', $data->namabahan) }}"
                                   required>

                        </div>

                    </div>

                    {{-- STOK --}}
                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Stok</label>

                            <input type="number"
                                   step="0.01"
                                   name="stok"
                                   class="form-control"
                                   value="{{ old('stok', $data->stok) }}"
                                   required>

                        </div>

                    </div>

                    {{-- SATUAN --}}
                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Satuan</label>

                            <input type="text"
                                   name="satuan"
                                   class="form-control"
                                   value="{{ old('satuan', $data->satuan) }}"
                                   required>

                        </div>

                    </div>

                    {{-- HARGA --}}
                    <div class="col-md-4">

                        <div class="form-group">

                            <label>Harga Beli</label>

                            <input type="number"
                                   step="0.01"
                                   name="hargabeli"
                                   class="form-control"
                                   value="{{ old('hargabeli', $data->hargabeli) }}"
                                   required>

                        </div>

                    </div>

                </div>

                <hr>

                <button class="btn btn-primary">

                    <i class="fas fa-save"></i>
                    Update Data

                </button>

                <a href="{{ route('inventory.bahanbaku.index') }}"
                   class="btn btn-secondary">

                    <i class="fas fa-times"></i>
                    Batal

                </a>

            </form>

        </div>

    </div>

</div>

@endsection