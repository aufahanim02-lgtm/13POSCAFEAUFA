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
                    Data Laporan Keuntungan
                </h3>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="table-dark">

                            <tr class="text-center">

                                <th width="50">No</th>
                                <th>Tanggal</th>
                                <th>Total Pemasukan</th>
                                <th>Total Pengeluaran</th>
                                <th>Keuntungan</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($data as $no => $row)

                            <tr>

                                <td class="text-center">
                                    {{ $no + 1 }}
                                </td>

                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}
                                </td>

                                <td class="fw-bold text-success">
                                    Rp {{ number_format($row->totalpemasukan, 0, ',', '.') }}
                                </td>

                                <td class="fw-bold text-danger">
                                    Rp {{ number_format($row->totalpengeluaran, 0, ',', '.') }}
                                </td>

                                <td>

                                    @if($row->keuntungan >= 0)

                                        <span class="badge badge-success px-3 py-2">

                                            Rp {{ number_format($row->keuntungan, 0, ',', '.') }}

                                        </span>

                                    @else

                                        <span class="badge badge-danger px-3 py-2">

                                            Rp {{ number_format($row->keuntungan, 0, ',', '.') }}

                                        </span>

                                    @endif

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5" class="text-center text-muted">

                                    Data laporan keuntungan kosong.

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