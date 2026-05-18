@extends('layouts.appmanager')
@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
    </div>

    {{-- FILTER --}}
    <div class="card shadow-sm mb-3">

        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-4">

                        <input type="date"
                               name="tanggal"
                               value="{{ $tanggal }}"
                               class="form-control">

                    </div>

                    <div class="col-md-2">

                        <button class="btn btn-primary w-100">

                            <i class="fas fa-search"></i>

                            Filter

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    {{-- STATISTIK --}}
    <div class="row">

        <div class="col-md-3">

            <div class="small-box bg-primary">

                <div class="inner">

                    <h3>{{ $totaltransaksi }}</h3>

                    <p>Total Transaksi</p>

                </div>

                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="small-box bg-success">

                <div class="inner">

                    <h3>
                        Rp {{ number_format($totalpendapatan,0,',','.') }}
                    </h3>

                    <p>Total Pendapatan</p>

                </div>

                <div class="icon">
                    <i class="fas fa-wallet"></i>
                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="small-box bg-warning">

                <div class="inner">

                    <h3>
                        Rp {{ number_format($totaldiskon,0,',','.') }}
                    </h3>

                    <p>Total Diskon</p>

                </div>

                <div class="icon">
                    <i class="fas fa-tags"></i>
                </div>

            </div>

        </div>

        <div class="col-md-3">

            <div class="small-box bg-danger">

                <div class="inner">

                    <h3>
                        Rp {{ number_format($totalpajak,0,',','.') }}
                    </h3>

                    <p>Total Pajak</p>

                </div>

                <div class="icon">
                    <i class="fas fa-percent"></i>
                </div>

            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="card shadow-sm">

        <div class="card-header">

            <h3 class="card-title">
                Data Laporan Harian
            </h3>

        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>

                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Total Transaksi</th>
                        <th>Total Pendapatan</th>
                        <th>Total Diskon</th>
                        <th>Total Pajak</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($data as $row)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            {{ date('d-m-Y', strtotime($row->tanggal)) }}
                        </td>

                        <td>
                            {{ $row->totaltransaksi }}
                        </td>

                        <td>
                            Rp {{ number_format($row->totalpendapatan,0,',','.') }}
                        </td>

                        <td>
                            Rp {{ number_format($row->totaldiskon,0,',','.') }}
                        </td>

                        <td>
                            Rp {{ number_format($row->totalpajak,0,',','.') }}
                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Data laporan kosong

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection