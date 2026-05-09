@extends('layouts.appkasir')

@section('title', 'Detail Struk')

@section('content')

<style>
    .struk-box {
        max-width: 420px;
        margin: auto;
        border: 1px dashed #444;
        padding: 20px;
        background: #fff;
        font-family: 'Courier New', monospace;
        font-size: 14px;
    }

    .struk-header {
        text-align: center;
        margin-bottom: 10px;
    }

    .struk-header h5 {
        margin: 0;
        font-weight: bold;
        font-size: 18px;
    }

    .struk-header small {
        display: block;
        font-size: 12px;
    }

    .struk-line {
        border-top: 1px dashed #333;
        margin: 10px 0;
    }

    .struk-table {
        width: 100%;
        font-size: 13px;
    }

    .struk-table td {
        padding: 3px 0;
        vertical-align: top;
    }

    .text-right {
        text-align: right;
    }

    .text-center {
        text-align: center;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        #areaPrint, #areaPrint * {
            visibility: visible;
        }

        #areaPrint {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .no-print {
            display: none !important;
        }
    }
</style>

<div class="container-fluid px-4 mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3 no-print">
        <div>
            <h4 class="mb-0">Detail Struk</h4>
            <small class="text-muted">Preview sebelum dicetak</small>
        </div>

        <div class="d-flex gap-2">
            {{-- tombol kembali --}}
            <a href="{{ route('kasir.cetakstruk.index') }}" class="btn btn-secondary btn-sm">
                ⬅ Kembali
            </a>

            {{-- tombol print (langsung simpan log ke database) --}}
            <a href="{{ route('kasir.cetakstruk.print', $penjualan->id) }}" class="btn btn-primary btn-sm">
                🖨 Print Struk
            </a>
        </div>
    </div>

    <div id="areaPrint">
        <div class="struk-box">

            <div class="struk-header">
                <h5>CAFEPOS</h5>
                <small>Jl. Contoh Alamat Cafe</small>
                <small>Telp: 08xx-xxxx-xxxx</small>
            </div>

            <div class="struk-line"></div>

            <table class="struk-table">
                <tr>
                    <td>ID Transaksi</td>
                    <td class="text-right">#{{ $penjualan->id }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td class="text-right">
                        {{ $penjualan->created_at ? $penjualan->created_at->format('d-m-Y H:i') : '-' }}
                    </td>
                </tr>
            </table>

            <div class="struk-line"></div>

            {{-- DETAIL ITEM --}}
            <table class="struk-table">
                @foreach($detail as $d)
                    <tr>
                        <td colspan="2">
                            <b>{{ $d->namaproduk ?? 'Produk' }}</b>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ $d->qty ?? 0 }} x Rp {{ number_format($d->harga ?? 0, 0, ',', '.') }}
                        </td>
                        <td class="text-right">
                            Rp {{ number_format($d->subtotal ?? (($d->qty ?? 0) * ($d->harga ?? 0)), 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </table>

            <div class="struk-line"></div>

            {{-- TOTAL --}}
            <table class="struk-table">
                <tr>
                    <td><b>TOTAL</b></td>
                    <td class="text-right">
                        <b>Rp {{ number_format($penjualan->total ?? 0, 0, ',', '.') }}</b>
                    </td>
                </tr>
                <tr>
                    <td>Bayar</td>
                    <td class="text-right">
                        Rp {{ number_format($pembayaran->bayar ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>Kembalian</td>
                    <td class="text-right">
                        Rp {{ number_format($pembayaran->kembalian ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
                <tr>
                    <td>Metode</td>
                    <td class="text-right">
                        {{ $pembayaran->metode ?? '-' }}
                    </td>
                </tr>
            </table>

            <div class="struk-line"></div>

            <div class="text-center">
                <small>Terima kasih telah berbelanja</small><br>
                <small>Semoga hari Anda menyenangkan 😊</small>
            </div>

        </div>
    </div>

</div>
@endsection