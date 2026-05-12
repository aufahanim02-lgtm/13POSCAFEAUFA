@extends('layouts.appkasir')

@section('title', 'Proses Pembayaran')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">💳 Proses Pembayaran</h3>
        <a href="{{ route('kasir.bayar.index') }}" class="btn btn-secondary btn-sm">
            ⬅ Kembali
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            <b>Error!</b> {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <p><b>Kode Invoice:</b> {{ $penjualan->kodeinvoice }}</p>
            <p><b>Pelanggan:</b> {{ $penjualan->pelanggan->name ?? '-' }}</p>
            <p><b>Meja:</b>
                @if($penjualan->meja)
                    Meja {{ $penjualan->meja->nomormeja }}
                @else
                    -
                @endif
            </p>

            <h4 class="fw-bold text-primary">
                Total Bayar: Rp {{ number_format($penjualan->total,0,',','.') }}
            </h4>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white fw-bold">
            Form Pembayaran
        </div>
        <div class="card-body">

            <form action="{{ route('kasir.bayar.proses', $penjualan->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Metode Pembayaran</label>
                    <select name="metodepembayaranid" class="form-control" required>
                        <option value="">-- Pilih Metode --</option>
                        @foreach($metode as $m)
                            <option value="{{ $m->id }}">
                                {{ $m->namametode }} ({{ strtoupper($m->jenis) }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Jumlah Bayar</label>
                    <input type="number"
                           name="jumlahbayar"
                           class="form-control"
                           required
                           min="0"
                           placeholder="Masukkan jumlah uang pelanggan">
                </div>

                <button type="submit" class="btn btn-success w-100 fw-bold">
                    💳 Proses Pembayaran
                </button>
            </form>

        </div>
    </div>

</div>
@endsection