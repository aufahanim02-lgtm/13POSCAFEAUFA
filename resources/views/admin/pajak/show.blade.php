@extends('layouts.appadmin')

@section('title', 'Detail Pajak')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Detail Pajak</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="30%">Nama Pajak</th>
                    <td>{{ $data->namapajak }}</td>
                </tr>

                <tr>
                    <th>Persen</th>
                    <td>{{ $data->persen }}%</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        @if($data->status == 'aktif')
                            <span class="badge bg-success">
                                AKTIF
                            </span>
                        @else
                            <span class="badge bg-danger">
                                NONAKTIF
                            </span>
                        @endif
                    </td>
                </tr>

            </table>

            <a href="{{ route('master.pajak.index') }}"
               class="btn btn-secondary">
                Kembali
            </a>

        </div>

    </div>

</div>

@endsection