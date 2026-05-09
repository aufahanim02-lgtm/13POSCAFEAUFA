@extends('layouts.appadmin')

@section('title', 'Metode Pembayaran')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">

        <h4>Metode Pembayaran</h4>

        <a href="{{ route('master.metodepembayaran.create') }}"
           class="btn btn-primary">

            + Tambah

        </a>

    </div>

    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif

    <div class="card">

        <div class="card-body table-responsive">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>
                        <th>No</th>
                        <th>QR Code</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Status</th>
                        <th width="20%">Aksi</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($data as $row)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>

                            @if($row->jenis == 'transfer' && $row->qrcode)

                                <img src="{{ asset('storage/' . $row->qrcode) }}"
                                     width="100">

                            @else

                                <span class="text-muted">
                                    -
                                </span>

                            @endif

                        </td>

                        <td>{{ $row->namametode }}</td>

                        <td>{{ $row->jenis }}</td>

                        <td>

                            @if($row->status == 'aktif')

                                <span class="badge bg-success">
                                    Aktif
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Nonaktif
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('master.metodepembayaran.edit', $row->id) }}"
                               class="btn btn-warning btn-sm">

                                Edit

                            </a>

                            <form action="{{ route('master.metodepembayaran.destroy', $row->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus data?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center">

                            Data metode pembayaran kosong

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection