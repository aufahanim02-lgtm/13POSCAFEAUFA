@extends('layouts.appkasir')

@section('title', 'Pembayaran Pelanggan')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">💳 Pembayaran Pesanan Pelanggan</h3>
        <small class="text-muted">
            Daftar pesanan pelanggan yang belum dibayar
        </small>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <b>Berhasil!</b>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        <b>Error!</b>
        {{ session('error') }}
    </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
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
                        <th>Status Bayar</th>
                        <th style="width:160px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $row)

                    <tr>

                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td class="fw-bold text-warning">
                            {{ $row->kodeinvoice }}
                        </td>

                        <td>
                            {{ $row->pelanggan->name ?? '-' }}
                        </td>

                        <td>

                            @if($row->meja)

                            <span class="badge bg-info text-dark">
                                Meja {{ $row->meja->nomormeja }}
                            </span>

                            @else

                            -

                            @endif

                        </td>

                        <td class="fw-bold text-success">
                            Rp {{ number_format($row->total ?? 0, 0, ',', '.') }}
                        </td>

                        <td>

                            @if($row->statuspesanan == 'menunggu')

                            <span class="badge bg-warning text-dark">
                                MENUNGGU
                            </span>

                            @elseif($row->statuspesanan == 'diproses')

                            <span class="badge bg-primary">
                                DIPROSES
                            </span>

                            @elseif($row->statuspesanan == 'siapdiambil')

                            <span class="badge bg-success">
                                SIAP DIAMBIL
                            </span>

                            @elseif($row->statuspesanan == 'selesai')

                            <span class="badge bg-dark">
                                SELESAI
                            </span>

                            @else

                            <span class="badge bg-danger">
                                DIBATALKAN
                            </span>

                            @endif

                        </td>

                        <td>

                            @if($row->statuspembayaran == 'belumbayar')

                                {{-- ========================================= --}}
                                {{-- JIKA SUDAH PILIH QRIS --}}
                                {{-- ========================================= --}}
                                @if($row->payment_gateway == 'qris')

                                <span class="badge bg-primary">
                                    QRIS
                                </span>

                                @else

                                <span class="badge bg-warning text-dark">
                                    BELUM BAYAR
                                </span>

                                @endif

                            @else

                            <span class="badge bg-success">
                                LUNAS
                            </span>

                            @endif

                        </td>

                        <td>

                            {{-- ========================================= --}}
                            {{-- BELUM BAYAR --}}
                            {{-- ========================================= --}}
                            @if($row->statuspembayaran == 'belumbayar')

                                {{-- ========================================= --}}
                                {{-- QRIS --}}
                                {{-- ========================================= --}}
                                @if($row->payment_gateway == 'qris')

                                <a
                                    href="{{ route('kasir.pembayaranpelanggan.qris', $row->id) }}"
                                    class="btn btn-sm btn-primary"
                                >
                                    <i class="fas fa-qrcode"></i>
                                    QRIS
                                </a>

                                @else

                                {{-- ========================================= --}}
                                {{-- CASH / PILIH METODE --}}
                                {{-- ========================================= --}}
                                <a
                                    href="{{ route('kasir.pembayaranpelanggan.form', $row->id) }}"
                                    class="btn btn-sm btn-success"
                                >
                                    <i class="fas fa-credit-card"></i>
                                    Bayar
                                </a>

                                @endif

                            @else

                            {{-- ========================================= --}}
                            {{-- SUDAH LUNAS --}}
                            {{-- ========================================= --}}
                            <button
                                class="btn btn-sm btn-secondary"
                                disabled
                            >
                                <i class="fas fa-check"></i>
                                Sudah Lunas
                            </button>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td
                            colspan="8"
                            class="text-center text-muted py-4"
                        >
                            Tidak ada pesanan pelanggan yang perlu dibayar.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection