@extends('layouts.appmanager')


@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <h1 class="fw-bold">Detail Laporan Produk</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-eye"></i> Detail Data Produk
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr><th width="30%">Produk</th><td>{{ $data->produk->namaproduk ?? '-' }}</td></tr>
                        <tr><th>Total Terjual</th><td>{{ $data->totalterjual }}</td></tr>
                        <tr><th>Total Pendapatan</th><td>Rp {{ number_format($data->totalpendapatan, 0, ',', '.') }}</td></tr>
                    </table>

                    <a href="{{ route('laporan.produk.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>

        </div>
    </section>

</div>
@endsection