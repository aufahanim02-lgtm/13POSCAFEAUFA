@extends('layouts.appkasir')

@section('title', 'Shift Kasir')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-times-circle"></i> {{ session('error') }}
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">
                        <i class="fas fa-user-clock"></i> Status Shift
                    </h3>
                </div>

                <div class="card-body">

                    @if($shiftAktif)
                        <div class="alert alert-success">
                            <b>Shift Sedang OPEN</b><br>
                            Mulai: {{ $shiftAktif->shiftmulai }} <br>
                            Saldo Awal: Rp {{ number_format($shiftAktif->saldoawal, 0, ',', '.') }}
                        </div>

                        {{-- ✅ FIX ROUTE --}}
                        <a href="{{ route('kasir.shift.tutup') }}" class="btn btn-danger">
                            <i class="fas fa-door-closed"></i> Tutup Shift
                        </a>
                    @else
                        <div class="alert alert-warning">
                            <b>Shift Belum Dibuka</b><br>
                            Silahkan buka shift sebelum transaksi.
                        </div>

                        {{-- ✅ FIX ROUTE --}}
                        <a href="{{ route('kasir.shift.buka') }}" class="btn btn-success">
                            <i class="fas fa-door-open"></i> Buka Shift
                        </a>
                    @endif

                </div>
            </div>

        </div>
    </section>

</div>
@endsection