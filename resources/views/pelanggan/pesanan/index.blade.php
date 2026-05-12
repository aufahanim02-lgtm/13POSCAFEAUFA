@extends('layouts.apppelanggan')

@section('title', 'Pesanan Saya')

@section('content')
<div class="container py-4">

    <h4 class="fw-bold mb-3">Pesanan Saya</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Invoice</th>
                            <th>Meja</th>
                            <th>Total</th>
                            <th>Status Pesanan</th>
                            <th>Status Bayar</th>
                            <th width="320">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pesanan as $row)
                        <tr>
                            <td class="fw-bold text-primary">{{ $row->kodeinvoice }}</td>

                            <td>
                                @if($row->meja)
                                    <span class="badge bg-info text-dark">
                                        Meja {{ $row->meja->nomormeja }}
                                    </span>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="fw-bold">
                                Rp {{ number_format($row->total, 0, ',', '.') }}
                            </td>

                            <td>
                                @if($row->statuspesanan == 'menunggu')
                                    <span class="badge bg-warning text-dark">MENUNGGU</span>
                                @elseif($row->statuspesanan == 'diproses')
                                    <span class="badge bg-primary">DIPROSES</span>
                                @elseif($row->statuspesanan == 'siapdiambil')
                                    <span class="badge bg-success">SIAP DIAMBIL</span>
                                @elseif($row->statuspesanan == 'selesai')
                                    <span class="badge bg-dark">SELESAI</span>
                                @else
                                    <span class="badge bg-danger">DIBATALKAN</span>
                                @endif
                            </td>

                            <td>
                                @if($row->statuspembayaran == 'belumbayar')
                                    <span class="badge bg-danger">BELUM BAYAR</span>
                                @else
                                    <span class="badge bg-success">LUNAS</span>
                                @endif
                            </td>

                            <td>

                                {{-- DETAIL --}}
                                <a href="{{ route('pelanggan.pesanan.detail', $row->id) }}"
                                   class="btn btn-sm btn-secondary">
                                    Detail
                                </a>

                                {{-- JIKA BELUM BAYAR --}}
                                @if($row->statuspembayaran == 'belumbayar')

                                    {{-- BAYAR DI KASIR --}}
                                    <form action="{{ route('pelanggan.pesanan.bayar.kasir', $row->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-warning"
                                                onclick="return confirm('Pesanan akan dibayar di kasir?')">
                                            Bayar di Kasir
                                        </button>
                                    </form>

                                    {{-- BAYAR QRIS --}}
                                    <form action="{{ route('pelanggan.pesanan.bayar.qris', $row->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-success"
                                                onclick="return confirm('Lanjut pembayaran QRIS sekarang?')">
                                            Bayar QRIS
                                        </button>
                                    </form>

                                @endif

                                {{-- LABEL METODE PEMBAYARAN --}}
                                @if($row->statuspembayaran == 'lunas' && $row->payment_gateway == 'qris')
                                    <span class="badge bg-success mt-1">QRIS</span>
                                @elseif($row->statuspembayaran == 'lunas' && $row->payment_gateway == 'cash')
                                    <span class="badge bg-primary mt-1">CASH</span>
                                @endif

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada pesanan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection