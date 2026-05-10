@extends('layouts.appmanager')

@section('title', 'Detail Bahan Baku')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Detail Bahan Baku
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>

                <th width="25%">
                    Kode Bahan
                </th>

                <td>
                    {{ $data->kodebahan }}
                </td>

            </tr>

            <tr>

                <th>
                    Nama Bahan
                </th>

                <td>
                    {{ $data->namabahan }}
                </td>

            </tr>

            <tr>

                <th>
                    Stok
                </th>

                <td>
                    {{ $data->stok }}
                </td>

            </tr>

            <tr>

                <th>
                    Satuan
                </th>

                <td>
                    {{ $data->satuan }}
                </td>

            </tr>

            <tr>

                <th>
                    Harga Beli
                </th>

                <td>
                    Rp {{ number_format($data->hargabeli,0,',','.') }}
                </td>

            </tr>

        </table>

    </div>

    <div class="card-footer">

        <a href="{{ route('inventory.bahanbaku.index') }}"
           class="btn btn-secondary">

            Kembali

        </a>

    </div>

</div>

@endsection