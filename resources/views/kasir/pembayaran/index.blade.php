@extends('layouts.appkasir')

@section('title', 'Pembayaran Pesanan')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">💳 Pembayaran Pesanan</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <b>Berhasil!</b> {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <b>Error!</b> {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Kode Invoice</th>
                        <th>Pelanggan</th>
                        <th>Meja</th>
                        <th>Total</th>
                        <th>Status Pesanan</th>
                        <th style="width:150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold text-primary">{{ $row->kodeinvoice }}</td>
                            <td>{{ $row->pelanggan->name ?? '-' }}</td>
                            <td>
                                @if($row->meja)
                                    <span class="badge bg-info">
                                        Meja {{ $row->meja->nomormeja }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="fw-bold">Rp {{ number_format($row->total,0,',','.') }}</td>
                            <td>
                                <span class="badge bg-success">
                                    {{ strtoupper($row->statuspesanan) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('kasir.bayar.form', $row->id) }}"
                                   class="btn btn-sm btn-success">
                                    Bayar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Tidak ada pesanan yang siap dibayar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>
@endsection