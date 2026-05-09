@extends('layouts.appadmin')

@section('title', 'Edit Pembelian')

@section('content')
<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h4 class="mb-0">Edit Pembelian</h4>
            <small class="text-muted">Ubah data transaksi pembelian</small>
        </div>

        <a href="{{ route('inventory.pembelian.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <b>Terjadi kesalahan:</b>
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('inventory.pembelian.update', $pembelian->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card shadow-sm mb-3">
            <div class="card-header">
                <b>Data Pembelian</b>
            </div>
            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Kode Pembelian</label>
                        <input type="text" name="kodepembelian" class="form-control"
                               value="{{ old('kodepembelian', $pembelian->kodepembelian) }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Supplier ID</label>
                        <input type="number" name="supplierid" class="form-control"
                               value="{{ old('supplierid', $pembelian->supplierid) }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tanggal Pembelian</label>
                        <input type="date" name="tanggalpembelian" class="form-control"
                               value="{{ old('tanggalpembelian', $pembelian->tanggalpembelian) }}" required>
                    </div>

                </div>

            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <b>Detail Pembelian</b>
                <button type="button" class="btn btn-success btn-sm" onclick="tambahBaris()">
                    <i class="fas fa-plus"></i> Tambah Item
                </button>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-bordered align-middle" id="tableDetail">
                        <thead class="table-dark">
                            <tr>
                                <th width="20%">Bahan Baku ID</th>
                                <th width="15%">Qty</th>
                                <th width="20%">Harga</th>
                                <th width="20%">Subtotal</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($detail as $d)
                                <tr>
                                    <td>
                                        <input type="number" name="bahanbakuid[]" class="form-control"
                                               value="{{ $d->bahanbakuid }}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="qty[]" class="form-control qty"
                                               value="{{ $d->qty }}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="harga[]" class="form-control harga"
                                               value="{{ $d->harga }}" required>
                                    </td>
                                    <td>
                                        <input type="number" name="subtotal[]" class="form-control subtotal"
                                               value="{{ $d->subtotal }}" readonly>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-4 offset-md-8">
                        <label class="form-label"><b>Total</b></label>
                        <input type="number" name="total" id="total" class="form-control"
                               value="{{ $pembelian->total }}" readonly>
                    </div>
                </div>

            </div>

            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Pembelian
                </button>
            </div>
        </div>

    </form>

</div>

<script>
function hitungSubtotal() {
    let total = 0;

    document.querySelectorAll("#tableDetail tbody tr").forEach(function(row) {
        let qty = row.querySelector(".qty").value || 0;
        let harga = row.querySelector(".harga").value || 0;
        let subtotal = qty * harga;

        row.querySelector(".subtotal").value = subtotal;
        total += subtotal;
    });

    document.getElementById("total").value = total;
}

document.addEventListener("input", function(e) {
    if (e.target.classList.contains("qty") || e.target.classList.contains("harga")) {
        hitungSubtotal();
    }
});

function tambahBaris() {
    let table = document.querySelector("#tableDetail tbody");
    let row = document.createElement("tr");

    row.innerHTML = `
        <td><input type="number" name="bahanbakuid[]" class="form-control" required></td>
        <td><input type="number" name="qty[]" class="form-control qty" required></td>
        <td><input type="number" name="harga[]" class="form-control harga" required></td>
        <td><input type="number" name="subtotal[]" class="form-control subtotal" readonly></td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;

    table.appendChild(row);
}

function hapusBaris(btn) {
    btn.closest("tr").remove();
    hitungSubtotal();
}

hitungSubtotal();
</script>
@endsection