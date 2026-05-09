@extends('layouts.appmanager')

@section('title', 'Laporan Kasir')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1 class="fw-bold">Laporan Kasir</h1>
            <small class="text-muted">Rekap transaksi kasir per hari</small>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-times-circle"></i> {{ session('error') }}
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-cash"></i> Data Laporan Kasir
                    </h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th>Total Transaksi</th>
                                <th>Total Pendapatan</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>

                                    <td class="text-center">
                                        <span class="badge bg-secondary">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                        </span>
                                    </td>

                                    <td>
                                        <b>{{ $item->kasir->name ?? '-' }}</b><br>
                                        <small class="text-muted">
                                            Username: {{ $item->kasir->username ?? '-' }}
                                        </small>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge bg-info">
                                            {{ $item->totaltransaksi }}
                                        </span>
                                    </td>

                                    <td class="text-end fw-bold text-success">
                                        Rp {{ number_format($item->totalpendapatan, 0, ',', '.') }}
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('laporan.kasir.show', $item->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted py-4">
                                        <i class="fas fa-folder-open"></i> Belum ada data laporan kasir.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </section>

</div>
@endsection