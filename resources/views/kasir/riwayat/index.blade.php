@extends('layouts.appkasir')

@section('title', 'Riwayat Transaksi')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
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
                        <i class="fas fa-history"></i> Riwayat Transaksi Kasir
                    </h3>
                </div>

                <div class="card-body">

                    {{-- FILTER --}}
                    <form method="GET" action="{{ route('kasir.riwayat.index') }}" class="row g-2 mb-3">
                        <div class="col-md-4">
                            <input type="text" name="search" value="{{ request('search') }}"
                                   class="form-control"
                                   placeholder="Cari kode invoice...">
                        </div>

                        <div class="col-md-3">
                            <select name="status" class="form-control">
                                <option value="">-- Semua Status --</option>
                                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>PAID</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>PENDING</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary w-100" type="submit">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('kasir.riwayat.index') }}" class="btn btn-secondary w-100">
                                <i class="fas fa-sync"></i> Reset
                            </a>
                        </div>
                    </form>

                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="bg-dark text-white">
                                <tr class="text-center">
                                    <th style="width: 50px;">No</th>
                                    <th>Kode Invoice</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th>Bayar</th>
                                    <th>Kembalian</th>
                                    <th style="width: 130px;">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($data as $item)
                                    <tr>
                                        <td class="text-center">
                                            {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                        </td>

                                        <td>
                                            <b>{{ $item->kodeinvoice }}</b>
                                        </td>

                                        <td class="text-center">
                                            {{ $item->tanggalpenjualan ? date('d-m-Y H:i', strtotime($item->tanggalpenjualan)) : '-' }}
                                        </td>

                                        <td class="text-center">
                                            @if($item->status == 'paid')
                                                <span class="badge badge-success px-3 py-2">PAID</span>
                                            @else
                                                <span class="badge badge-warning px-3 py-2">PENDING</span>
                                            @endif
                                        </td>

                                        <td>
                                            Rp {{ number_format($item->total, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            Rp {{ number_format($item->pembayaran->jumlahbayar ?? 0, 0, ',', '.') }}
                                        </td>

                                        <td>
                                            Rp {{ number_format($item->pembayaran->kembalian ?? 0, 0, ',', '.') }}
                                        </td>

                                        <td class="text-center">
                                            <a href="{{ route('kasir.riwayat.show', $item->id) }}"
                                               class="btn btn-info btn-sm text-white">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="fas fa-folder-open"></i> Belum ada transaksi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- PAGINATION --}}
                    <div class="mt-3">
                        {{ $data->withQueryString()->links() }}
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>
@endsection