@extends('layouts.appkasir')

@section('title', 'Tutup Shift')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <h1 class="fw-bold text-danger">
                <i class="fas fa-door-closed"></i> Tutup Shift Kasir
            </h1>
            <small class="text-muted">Pastikan semua transaksi sudah selesai sebelum menutup shift</small>
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

            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white">
                    <h3 class="card-title fw-bold mb-0">
                        <i class="fas fa-door-closed"></i> Konfirmasi Tutup Shift
                    </h3>
                </div>

                <div class="card-body">

                    @if($shiftAktif)

                        <div class="alert alert-info">
                            <b>Shift Mulai:</b> {{ $shiftAktif->shiftmulai }} <br>
                            <b>Saldo Awal:</b> Rp {{ number_format($shiftAktif->saldoawal, 0, ',', '.') }} <br>
                            <hr>
                            <b>Total Transaksi:</b> {{ $totalTransaksi }} <br>
                            <b>Total Pendapatan:</b> Rp {{ number_format($totalPendapatan, 0, ',', '.') }} <br>
                            <hr>
                            <b>Saldo Akhir Otomatis:</b>
                            <span class="text-success fw-bold">
                                Rp {{ number_format($saldoAkhirOtomatis, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- FIX UTAMA ADA DISINI --}}
                        <form action="{{ route('kasir.shift.tutup.proses') }}" method="POST"
                              onsubmit="return confirm('Yakin ingin menutup shift?')">
                            @csrf

                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times"></i> Tutup Shift Sekarang
                            </button>

                            <a href="{{ route('kasir.shift.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </form>

                    @else
                        <div class="alert alert-warning">
                            Tidak ada shift yang sedang OPEN.
                        </div>

                        <a href="{{ route('kasir.shift.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    @endif

                </div>
            </div>

        </div>
    </section>

</div>
@endsection