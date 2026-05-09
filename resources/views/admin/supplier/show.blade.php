@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="card">

        <div class="card-header">
            <h4>Detail Supplier</h4>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="25%">Nama Supplier</th>
                    <td>{{ $data->namasupplier }}</td>
                </tr>

                <tr>
                    <th>No HP</th>
                    <td>{{ $data->nohp ?? '-' }}</td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>{{ $data->alamat ?? '-' }}</td>
                </tr>

            </table>

            <a href="{{ route('master.supplier.index') }}"
               class="btn btn-secondary">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection