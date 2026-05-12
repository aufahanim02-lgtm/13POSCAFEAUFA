@extends('layouts.appkasir')

@section('title', 'Pesanan Masuk')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">📥 Pesanan Masuk Pelanggan</h3>
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
                        <th>Status Bayar</th>
                        <th style="width:220px;">Aksi</th>
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

                        <td class="fw-bold">
                            Rp {{ number_format($row->total,0,',','.') }}
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

                            <!-- DETAIL -->
                            <a href="{{ route('kasir.pesananmasuk.show', $row->id) }}"
                               class="btn btn-sm btn-secondary">
                                Detail
                            </a>

                            <!-- MENUNGGU → DIPROSES -->
                            @if($row->statuspesanan == 'menunggu')
                                <form action="{{ route('kasir.pesananmasuk.diproses', $row->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-success"
                                            onclick="return confirm('Proses pesanan ini?')">
                                        Setujui
                                    </button>
                                </form>

                                <form action="{{ route('kasir.pesananmasuk.batalkan', $row->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Tolak pesanan ini?')">
                                        Tolak
                                    </button>
                                </form>
                            @endif


                            <!-- DIPROSES → SIAP -->
                            @if($row->statuspesanan == 'diproses')
                                <form action="{{ route('kasir.pesananmasuk.siap', $row->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-warning"
                                            onclick="return confirm('Ubah menjadi siap diambil?')">
                                        Siap Ambil
                                    </button>
                                </form>
                            @endif


                            <!-- SIAP + LUNAS → SELESAI -->
                            @if($row->statuspesanan == 'siapdiambil' && $row->statuspembayaran == 'lunas')
                                <form action="{{ route('kasir.pesananmasuk.selesai', $row->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    <button class="btn btn-sm btn-dark"
                                            onclick="return confirm('Selesaikan pesanan?')">
                                        Selesai
                                    </button>
                                </form>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Tidak ada pesanan masuk.
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection