@extends('layouts.appkasir')

@section('title', 'Pembayaran')

@section('content')

<div class="container-fluid">

    <div class="card card-primary">

        <div class="card-header">
            <h3 class="card-title">
                Pembayaran
            </h3>
        </div>

        <div class="card-body">

            {{-- ERROR --}}
            @if(session('error'))

            <div class="alert alert-danger">
                {{ session('error') }}
            </div>

            @endif

            {{-- TOTAL --}}
            <h5>
                Subtotal :
                <span class="float-right">
                    Rp {{ number_format($subtotal,0,',','.') }}
                </span>
            </h5>

            {{-- DISKON --}}
            @if($promo)

            <h5 class="text-danger">

                Diskon
                ({{ $promo->namapromo }}) :

                <span class="float-right">

                    - Rp {{ number_format($diskon,0,',','.') }}

                </span>

            </h5>

            @endif

            {{-- PAJAK --}}
            @if($pajak)

            <h5 class="text-primary">

                Pajak
                ({{ $pajak->namapajak }}) :

                <span class="float-right">

                    + Rp {{ number_format($totalPajak,0,',','.') }}

                </span>

            </h5>

            @endif

            <hr>

            {{-- TOTAL AKHIR --}}
            <h3>

                Total Bayar :

                <span class="float-right text-success">

                    Rp {{ number_format($totalAkhir,0,',','.') }}

                </span>

            </h3>

            <hr>

            {{-- FORM --}}
            <form action="{{ route('kasir.pembayaran.proses') }}"
                method="POST">

                @csrf

                {{-- MEJA --}}
                <div class="form-group mb-3">

                    <label>Meja</label>
                    <select name="mejaid" class="form-control">

                        <option value="">
                            -- Pilih Meja --
                        </option>

                        @foreach($meja as $m)

                        <option value="{{ $m->id }}">

                            {{ $m->nomormeja }}
                            - Kapasitas {{ $m->kapasitas }}

                        </option>

                        @endforeach

                    </select>

                </div>

                {{-- METODE PEMBAYARAN --}}
                <div class="form-group mb-3">

                    <label>Metode Pembayaran</label>

                    <select name="metodepembayaranid"
                        class="form-control"
                        required>

                        @foreach($metode as $m)

                        <option value="{{ $m->id }}">

                            {{ $m->namametode }}

                        </option>

                        @endforeach

                    </select>

                </div>

                {{-- JUMLAH BAYAR --}}
                <div class="form-group mb-3">

                    <label>Jumlah Bayar</label>

                    <input type="number"
                        name="jumlahbayar"
                        class="form-control"
                        required>

                </div>

                {{-- BUTTON --}}
                <button class="btn btn-success w-100">

                    <i class="fas fa-check-circle"></i>

                    Proses Pembayaran

                </button>

            </form>

        </div>

    </div>

</div>

@endsection