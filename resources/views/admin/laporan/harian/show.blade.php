@extends('layouts.appadmin')


@section('content')


    <section class="content-header">
        <div class="container-fluid">
            <h1 class="fw-bold">Detail Laporan Harian</h1>
            <small class="text-muted">Rincian transaksi berdasarkan tanggal</small>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title">
                        <i class="fas fa-file-alt"></i> Detail Laporan
                    </h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th style="width:200px;">Tanggal</th>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Total Transaksi</th>
                            <td>{{ $data->totaltransaksi }}</td>
                        </tr>
                        <tr>
                            <th>Total Pendapatan</th>
                            <td>Rp {{ number_format($data->totalpendapatan, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>

                <div class="card-footer">
                    <a href="{{ route('laporan.harian.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection