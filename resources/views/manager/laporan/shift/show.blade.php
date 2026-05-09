@extends('layouts.appmanager')

@section('title', 'Detail Laporan Shift')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1 class="fw-bold">Detail Laporan Shift</h1>
            <small class="text-muted">Detail laporan transaksi shift per hari</small>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h3 class="card-title">
                        <i class="fas fa-receipt"></i> Detail Laporan Shift
                    </h3>
                </div>

                <div class="card-body">

                    <table class="table table-bordered">

                        <tr>
                            <th width="30%">Tanggal</th>
                            <td>
                                <span class="badge bg-dark">
                                    {{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Kasir</th>
                            <td>{{ $row->user->name ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Username</th>
                            <td>{{ $row->user->username ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Shift ID</th>
                            <td>
                                <span class="badge bg-secondary">
                                    #{{ $row->shiftid }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Shift Mulai</th>
                            <td>{{ $row->shift->shiftmulai ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Shift Selesai</th>
                            <td>{{ $row->shift->shiftselesai ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Total Transaksi</th>
                            <td>
                                <span class="badge bg-info">
                                    {{ $row->totaltransaksi }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Total Pendapatan</th>
                            <td class="fw-bold text-success">
                                Rp {{ number_format($row->totalpendapatan, 0, ',', '.') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Created At</th>
                            <td>{{ $row->created_at }}</td>
                        </tr>

                        <tr>
                            <th>Updated At</th>
                            <td>{{ $row->updated_at }}</td>
                        </tr>

                    </table>

                    <div class="mt-3">
                        <a href="{{ route('laporan.shift.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>
@endsection