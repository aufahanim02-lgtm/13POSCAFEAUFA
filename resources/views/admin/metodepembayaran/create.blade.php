@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Tambah Metode Pembayaran</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('master.metodepembayaran.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="mb-3">

                    <label>Nama Metode</label>

                    <input type="text"
                           name="namametode"
                           class="form-control"
                           required>

                </div>

                <div class="mb-3">

                    <label>Jenis</label>

                    <select name="jenis"
                            class="form-control"
                            required>

                        <option value="">-- Pilih --</option>
                        <option value="cash">Cash</option>
                        <option value="transfer">Transfer</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Status</label>

                    <select name="status"
                            class="form-control">

                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>

                    </select>

                </div>

                <div class="mb-3">

                    <label>Upload QR Code</label>

                    <input type="file"
                           name="qrcode"
                           class="form-control">

                    <small class="text-muted">
                        Upload QRIS / Barcode transfer
                    </small>

                </div>

                <button type="submit"
                        class="btn btn-primary">

                    Simpan

                </button>

            </form>

        </div>

    </div>

</div>

@endsection