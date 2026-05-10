@extends('layouts.appmanager')

@section('title', 'Data Pembelian')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between">

        <h3 class="card-title">
            Data Pembelian
        </h3>

        <a href="{{ route('inventory.pembelian.create') }}"
            class="btn btn-primary btn-sm">

            <i class="fas fa-plus"></i>
            Tambah

        </a>

    </div>

    <div class="card-body">

        @if(session('success'))

            <div class="alert alert-success">
                {{ session('success') }}
            </div>

        @endif

        <table class="table table-bordered table-striped">

            <thead>

                <tr>

                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th width="220">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($data as $no => $row)

                    <tr>

                        <td>{{ $no + 1 }}</td>

                        <td>
                            {{ $row->tanggalpembelian }}
                        </td>

                        <td>
                            Rp {{ number_format($row->total,0,',','.') }}
                        </td>

                        <td>

                            <a href="{{ route('inventory.pembelian.show',$row->id) }}"
                                class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                            </a>

                            <a href="{{ route('inventory.pembelian.edit',$row->id) }}"
                                class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form action="{{ route('inventory.pembelian.destroy',$row->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus data?')">

                                    <i class="fas fa-trash"></i>

                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center">
                            Data pembelian kosong
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection