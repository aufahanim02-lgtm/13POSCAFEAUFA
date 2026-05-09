<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Print Struk</title>

    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .struk-box {
            max-width: 420px;
            margin: auto;
            border: 1px dashed #444;
            padding: 20px;
        }

        .struk-header {
            text-align: center;
            margin-bottom: 10px;
        }

        .struk-header h4 {
            margin: 0;
            font-size: 18px;
        }

        .struk-line {
            border-top: 1px dashed #333;
            margin: 10px 0;
        }

        table {
            width: 100%;
            font-size: 13px;
        }

        td {
            padding: 3px 0;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print(); window.onafterprint = () => window.close();">

<div class="struk-box">

    <div class="struk-header">
        <h4>CAFEPOS</h4>
        <small>Jl. Contoh Alamat Cafe</small><br>
        <small>Telp: 08xx-xxxx-xxxx</small>
    </div>

    <div class="struk-line"></div>

    <table>
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

    {{-- DETAIL --}}
    <table>
        @foreach($detail as $d)
            <tr>
                <td colspan="2">
                    <b>{{ $d->namaproduk ?? 'Produk' }}</b>
                </td>
            </tr>
            <tr>
                <td>{{ $d->qty ?? 0 }} x Rp {{ number_format($d->harga ?? 0, 0, ',', '.') }}</td>
                <td class="text-right">
                    Rp {{ number_format($d->subtotal ?? (($d->qty ?? 0) * ($d->harga ?? 0)), 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </table>

    <div class="struk-line"></div>

    {{-- TOTAL --}}
    <table>
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

</body>
</html>