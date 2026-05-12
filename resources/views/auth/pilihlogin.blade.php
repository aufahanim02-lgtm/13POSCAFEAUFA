@extends('layouts.appguest')

@section('title', 'Pilih Login')

@section('content')

<div class="container py-5" style="margin-top:90px;">

    <div class="text-center mb-4">
        <h3>Pilih Login</h3>
        <p>Silakan masuk sesuai peran Anda</p>
    </div>

    <div class="row justify-content-center g-4">

        {{-- PELANGGAN --}}
        <div class="col-md-4">
            <div class="glass-card text-center p-4">
                <h4>Pelanggan</h4>
                <p>Untuk memesan menu di aplikasi</p>

                <a href="{{ route('pelanggan.login') }}" class="btn btn-success w-100">
                    Login Pelanggan
                </a>

                <a href="{{ route('pelanggan.register') }}" class="btn btn-outline-light w-100 mt-2">
                    Daftar Pelanggan
                </a>
            </div>
        </div>

        {{-- KARYAWAN --}}
        <div class="col-md-4">
            <div class="glass-card text-center p-4">
                <h4>Kasir / Owner / Manager</h4>
                <p>Untuk dashboard sistem</p>

                <a href="{{ route('auth.login') }}" class="btn btn-primary w-100">
                    Login Admin
                </a>
            </div>
        </div>

    </div>

</div>

@endsection