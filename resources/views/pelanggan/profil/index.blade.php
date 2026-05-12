@extends('layouts.apppelanggan')

@section('title', 'Profil')
@section('header', 'Profil Saya')

@section('content')
@php
$pelanggan = Auth::guard('pelanggan')->user();
@endphp

<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="fw-bold mb-1">Profil Saya</h3>
            <p class="text-muted mb-0">Informasi akun pelanggan yang sedang login.</p>
        </div>

        <a href="{{ route('pelanggan.profil.edit') }}" class="btn btn-primary rounded-3 px-4">
            <i class="fa-solid fa-pen-to-square me-2"></i> Edit Profil
        </a>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            <div class="row g-4 align-items-center">

                {{-- FOTO --}}
                @if($pelanggan && $pelanggan->foto)
                <img src="{{ asset('storage/pelanggan/' . $pelanggan->foto) }}"
                    class="rounded-circle shadow"
                    style="width:140px;height:140px;object-fit:cover;">
                @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($pelanggan->name ?? 'Pelanggan') }}&background=111827&color=fff"
                    class="rounded-circle shadow"
                    style="width:140px;height:140px;object-fit:cover;">
                @endif
                {{-- DATA --}}
                <div class="col-md-9">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-light">
                                <small class="text-muted d-block">Nama</small>
                                <div class="fw-bold">{{ $pelanggan->name ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-light">
                                <small class="text-muted d-block">Username</small>
                                <div class="fw-bold">{{ $pelanggan->username ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-light">
                                <small class="text-muted d-block">Email</small>
                                <div class="fw-bold">{{ $pelanggan->email ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-light">
                                <small class="text-muted d-block">No HP</small>
                                <div class="fw-bold">{{ $pelanggan->nohp ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-light">
                                <small class="text-muted d-block">Point</small>
                                <div class="fw-bold text-success">{{ $pelanggan->point ?? 0 }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="p-3 rounded-4 bg-light">
                                <small class="text-muted d-block">Level Member</small>
                                <div class="fw-bold text-primary">
                                    {{ strtoupper($pelanggan->levelmember ?? '-') }}
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr class="my-4">

                    <div class="text-muted small">
                        Akun pelanggan aktif digunakan untuk transaksi dan pemesanan menu cafe.
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>
@endsection