@extends('layouts.appmanager')

@section('title', 'Laporan')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Menu Laporan
        </h3>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-4 mb-3">

                <a href="{{ route('laporan.harian.index') }}"
                    class="btn btn-primary w-100">

                    Laporan Harian

                </a>

            </div>

            <div class="col-md-4 mb-3">

                <a href="{{ route('laporan.bulanan.index') }}"
                    class="btn btn-success w-100">

                    Laporan Bulanan

                </a>

            </div>

            <div class="col-md-4 mb-3">

                <a href="{{ route('laporan.produk.index') }}"
                    class="btn btn-warning w-100">

                    Laporan Produk

                </a>

            </div>

            <div class="col-md-4 mb-3">

                <a href="{{ route('laporan.kasir.index') }}"
                    class="btn btn-info w-100">

                    Laporan Kasir

                </a>

            </div>

            <div class="col-md-4 mb-3">

                <a href="{{ route('laporan.shift.index') }}"
                    class="btn btn-secondary w-100">

                    Laporan Shift

                </a>

            </div>

            <div class="col-md-4 mb-3">

                <a href="{{ route('laporan.keuntungan.index') }}"
                    class="btn btn-danger w-100">

                    Laporan Keuntungan

                </a>

            </div>

        </div>

    </div>

</div>

@endsection