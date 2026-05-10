@extends('layouts.appmanager')

@section('title', 'Detail Pembelian')

@section('content')

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Detail Pembelian
        </h3>

    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <tr>
                <th>Tanggal</th>
                <td>{{ $pembelian->tanggalpembelian }}</td>
            </tr>

            <tr>
                <th>Total</th>
                <td>
                    Rp {{ number_format($pembelian->total,0,',','.') }}
                </td>
            </tr>

        </table>

    </div>

</div>

@endsection