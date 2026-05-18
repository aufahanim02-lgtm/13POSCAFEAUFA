@extends('layouts.appadmin')
@section('content')

<div class="content-header">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

        </div>

    </div>
</div>

<section class="content">
    <div class="container-fluid">

        <div class="card shadow-sm">

            <div class="card-header bg-dark">
                <h3 class="card-title text-white">
                    Data Laporan Kasir
                </h3>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="table-dark">

                            <tr class="text-center">
                                <th width="50">No</th>
                                <th>Nama Kasir</th>
                                <th>Tanggal</th>
                                <th>Total Transaksi</th>
                                <th>Total Pendapatan</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($data as $no => $row)

                            <tr>

                                <td class="text-center">
                                    {{ $no + 1 }}
                                </td>

                                <td>
                                    {{ $row->kasir->name ?? '-' }}
                                </td>

                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}
                                </td>

                                <td class="text-center">

                                    <span class="badge badge-info px-3 py-2">
                                        {{ $row->totaltransaksi }}
                                    </span>

                                </td>

                                <td class="fw-bold text-success">
                                    Rp {{ number_format($row->totalpendapatan, 0, ',', '.') }}
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Data laporan kasir kosong.
                                </td>
                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
</section>

@endsection