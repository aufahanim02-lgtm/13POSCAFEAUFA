@extends('layouts.appadmin')

@section('title', 'Detail Metode Pembayaran')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Detail Metode Pembayaran</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="25%">Nama Metode</th>
                    <td>{{ $data->namametode }}</td>
                </tr>

                <tr>
                    <th>Jenis</th>
                    <td>{{ $data->jenis }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>{{ $data->status }}</td>
                </tr>

                <tr>
                    <th>QR Code</th>

                    <td>

                        @if($data->qrcode)

                            <img src="{{ asset('storage/' . $data->qrcode) }}"
                                 width="200"
                                 class="img-thumbnail">

                        @else

                            <span class="text-muted">
                                Tidak ada QR Code
                            </span>

                        @endif

                    </td>

                </tr>

            </table>

            <a href="{{ route('master.metodepembayaran.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection