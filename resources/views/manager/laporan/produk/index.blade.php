@extends('layouts.appmanager')

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
                    Data Laporan Produk
                </h3>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="table-dark">

                            <tr class="text-center">
                                <th width="50">No</th>
                                <th>Nama Produk</th>
                                <th>Total Terjual</th>
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
                                    {{ $row->produk->namaproduk ?? '-' }}
                                </td>

                                <td class="text-center">
                                    <span class="badge badge-success px-3 py-2">
                                        {{ $row->totalterjual }}
                                    </span>
                                </td>

                                <td class="fw-bold text-success">
                                    Rp {{ number_format($row->totalpendapatan, 0, ',', '.') }}
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    Data laporan produk kosong.
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