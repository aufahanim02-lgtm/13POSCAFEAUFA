@extends('layouts.apppelanggan')

@section('title', 'Keranjang')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-1">Keranjang Belanja</h3>
            <p class="text-muted mb-0">Cek pesanan sebelum checkout</p>
        </div>
        <a href="{{ url('/pelanggan/menu') }}" class="btn btn-outline-primary">
            <i class="bi bi-shop"></i> Tambah Menu
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(isset($keranjang) && count($keranjang) > 0)
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th width="140">Qty</th>
                            <th>Subtotal</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach($keranjang as $row)
                        @php $grandTotal += $row->subtotal; @endphp
                        <tr>
                            <td>
                                <b>{{ $row->produk->namaproduk ?? '-' }}</b>
                            </td>
                            <td>Rp {{ number_format($row->harga ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $row->qty }}</td>
                            <td>Rp {{ number_format($row->subtotal ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ url('/pelanggan/keranjang/hapus/'.$row->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus item ini?')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <th colspan="3" class="text-end">Total</th>
                            <th colspan="2" class="text-success fw-bold">
                                Rp {{ number_format($grandTotal, 0, ',', '.') }}
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('pelanggan.checkout.index') }}" class="btn btn-success">
                    <i class="bi bi-credit-card"></i> Checkout Sekarang
                </a>
            </div>

        </div>
    </div>
    @else
    <div class="text-center py-5">
        <h5 class="fw-bold">Keranjang kosong</h5>
        <p class="text-muted">Silahkan pilih menu untuk dipesan.</p>
        <a href="{{ url('/pelanggan/menu') }}" class="btn btn-primary">
            Pilih Menu
        </a>
    </div>
    @endif

</div>
@endsection