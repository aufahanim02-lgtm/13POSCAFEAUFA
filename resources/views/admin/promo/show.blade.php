@extends('layouts.appadmin')


@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Detail Promo</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">
                <tr>
                    <th>Nama Promo</th>
                    <td>{{ $data->namapromo }}</td>
                </tr>

                <tr>
                    <th>Jenis</th>
                    <td>{{ strtoupper($data->jenis) }}</td>
                </tr>

                <tr>
                    <th>Nilai Diskon</th>
                    <td>{{ $data->nilaidiskon }}</td>
                </tr>

                <tr>
                    <th>Minimal Belanja</th>
                    <td>
                        Rp {{ number_format($data->minimalbelanja,0,',','.') }}
                    </td>
                </tr>

                <tr>
                    <th>Tanggal Mulai</th>
                    <td>{{ $data->tanggalmulai }}</td>
                </tr>

                <tr>
                    <th>Tanggal Selesai</th>
                    <td>{{ $data->tanggalselesai }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ $data->status }}</td>
                </tr>

            </table>

            <a href="{{ route('master.promo.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </div>

</div>

@endsection