@extends('layouts.appkasir')

@section('title', 'Detail Pesanan')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">🧾 Detail Pesanan</h3>

        <a href="{{ route('kasir.pesananmasuk.index') }}" class="btn btn-secondary btn-sm">
            ← Kembali
        </a>
    </div>

    <div class="card shadow-sm mb-3">
        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="p-3 border rounded">
                        <small class="text-muted">Kode Invoice</small>
                        <div class="fw-bold text-primary">
                            {{ $data->kodeinvoice }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 border rounded">
                        <small class="text-muted">Pelanggan</small>
                        <div class="fw-bold">
                            {{ $data->pelanggan->name ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 border rounded">
                        <small class="text-muted">Meja</small>
                        <div class="fw-bold">
                            @if($data->meja)
                                Meja {{ $data->meja->nomormeja }}
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 border rounded">
                        <small class="text-muted">Status Pesanan</small>
                        <div class="fw-bold">
                            {{ strtoupper($data->statuspesanan) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 border rounded">
                        <small class="text-muted">Status Pembayaran</small>
                        <div class="fw-bold">
                            {{ strtoupper($data->statuspembayaran) }}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="p-3 border rounded">
                        <small class="text-muted">Total</small>
                        <div class="fw-bold text-success">
                            Rp {{ number_format($data->total, 0, ',', '.') }}
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>


    {{-- LIST ITEM --}}
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white fw-bold">
            📦 Item Pesanan
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Produk</th>
                        <th>Qty</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($data->detail as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-bold">{{ $row->produk->namaproduk ?? '-' }}</td>
                            <td>{{ $row->qty }}</td>
                            <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                            <td class="fw-bold text-success">
                                Rp {{ number_format($row->subtotal, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>


    {{-- AKSI STATUS --}}
    <div class="mt-3">

        @if($data->statuspesanan == 'menunggu')
            <form action="{{ route('kasir.pesananmasuk.diproses', $data->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-success"
                        onclick="return confirm('Setujui pesanan ini?')">
                    Setujui (Diproses)
                </button>
            </form>

            <form action="{{ route('kasir.pesananmasuk.batalkan', $data->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-danger"
                        onclick="return confirm('Batalkan pesanan ini?')">
                    Batalkan
                </button>
            </form>
        @endif

        @if($data->statuspesanan == 'diproses')
            <form action="{{ route('kasir.pesananmasuk.siap', $data->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-warning"
                        onclick="return confirm('Ubah menjadi siap diambil?')">
                    Siap Diambil
                </button>
            </form>
        @endif

        @if($data->statuspesanan == 'siapdiambil' && $data->statuspembayaran == 'lunas')
            <form action="{{ route('kasir.pesananmasuk.selesai', $data->id) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-dark"
                        onclick="return confirm('Selesaikan pesanan ini?')">
                    Selesai
                </button>
            </form>
        @endif

    </div>

</div>
@endsection