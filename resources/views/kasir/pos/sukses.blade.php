@extends('layouts.appkasir')

@section('title', 'Sukses')

@section('content')

<div class="container-fluid">

    <div class="card card-success">

        <div class="card-body text-center">

            <h3 class="text-success mb-3">
                Pembayaran Berhasil!
            </h3>

            <p>
                Invoice :
                <b>{{ $penjualan->kodeinvoice }}</b>
            </p>

            <p>
                Total :
                <b>
                    Rp {{ number_format($penjualan->total, 0, ',', '.') }}
                </b>
            </p>

            <hr>

            {{-- CETAK STRUK --}}
            <a href="{{ route('kasir.cetakstruk.show', $penjualan->id) }}"
                class="btn btn-primary">

                <i class="fas fa-print"></i>
                Cetak Struk

            </a>

            {{-- TRANSAKSI BARU --}}
            <a href="{{ route('kasir.pos') }}"
                class="btn btn-success">

                <i class="fas fa-cash-register"></i>
                Transaksi Baru

            </a>

        </div>

    </div>

</div>

@endsection