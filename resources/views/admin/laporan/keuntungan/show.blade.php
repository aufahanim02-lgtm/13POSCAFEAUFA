@extends('layouts.appadmin')



@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h1 class="fw-bold">Detail Laporan Keuntungan</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title mb-0"><i class="fas fa-eye"></i> Detail Keuntungan</h3>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <tr><th width="30%">Tanggal</th><td>{{ $data->tanggal }}</td></tr>
                        <tr><th>Total Pemasukan</th><td>Rp {{ number_format($data->totalpemasukan, 0, ',', '.') }}</td></tr>
                        <tr><th>Total Pengeluaran</th><td>Rp {{ number_format($data->totalpengeluaran, 0, ',', '.') }}</td></tr>
                        <tr><th>Keuntungan</th><td>Rp {{ number_format($data->keuntungan, 0, ',', '.') }}</td></tr>
                    </table>

                    <a href="{{ route('laporan.keuntungan.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>

            </div>

        </div>
    </section>
</div>
@endsection