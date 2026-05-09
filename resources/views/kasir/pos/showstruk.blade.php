@extends('layouts.appkasir')

@section('title', 'Cetak Struk')

@section('content')
<div class="container-fluid px-4">

    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
        <div>
            <h4 class="mb-0">Cetak Struk</h4>
            <small class="text-muted">Daftar transaksi yang bisa dicetak ulang</small>
        </div>
        <a href="{{ route('dashboard.kasir') }}" class="btn btn-secondary btn-sm">
            ⬅ Kembali Dashboard
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    <b>Berhasil!</b> {{ session('success') }}
                </div>
            @endif

            @if($data->count() == 0)
                <div class="alert alert-warning">
                    Belum ada transaksi penjualan yang tersedia untuk dicetak.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">ID Penjualan</th>
                                <th width="25%">Tanggal</th>
                                <th width="25%">Total</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>

                                    <td class="text-center">
                                        <span class="badge bg-primary">
                                            #{{ $item->id }}
                                        </span>
                                    </td>

                                    <td class="text-center">
                                        {{ $item->created_at ? $item->created_at->format('d-m-Y H:i') : '-' }}
                                    </td>

                                    <td class="text-end">
                                        <b>Rp {{ number_format($item->total ?? 0, 0, ',', '.') }}</b>
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('kasir.cetakstruk.show', $item->id) }}"
                                           class="btn btn-sm btn-success">
                                            🧾 Lihat & Cetak
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            @endif

        </div>
    </div>

</div>
@endsection