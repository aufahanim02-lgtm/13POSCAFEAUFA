@extends('layouts.appmanager')

@section('title', 'Laporan')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1 class="fw-bold">Laporan (Owner)</h1>
            <small class="text-muted">Kelola laporan sistem</small>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-file-alt"></i> Data Laporan
                    </h3>

                    <a href="{{ route('laporan.create') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-plus"></i> Tambah Laporan
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th>Jenis Laporan</th>
                                <th>Periode</th>
                                <th>Total Data</th>
                                <th width="25%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->jenislaporan }}</td>
                                    <td>
                                        {{ $item->periodeawal ?? '-' }} s/d {{ $item->periodeakhir ?? '-' }}
                                    </td>
                                    <td>{{ $item->totaldata }}</td>
                                    <td>
                                        <a href="{{ route('laporan.show', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('laporan.edit', $item->id) }}" class="btn btn-warning btn-sm text-white">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="{{ route('laporan.delete', $item->id) }}"
                                           onclick="return confirm('Yakin hapus laporan ini?')"
                                           class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">
                                        Belum ada laporan.
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