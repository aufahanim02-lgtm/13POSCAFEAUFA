@extends('layouts.appmanager')

@section('title', 'Data Stok Keluar')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">
            Data Stok Keluar
        </h3>

        <a href="{{ route('inventory.stokkeluar.create') }}"
           class="btn btn-primary btn-sm">
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
                    <th>Bahan Baku</th>
                    <th>Jumlah</th>
                    <th>Tanggal Keluar</th>
                    <th>Alasan</th>
                    <th width="250">Aksi</th>
                </tr>

            </thead>

            <tbody>

                @forelse($data as $no => $row)

                <tr>

                    <td>{{ $no + 1 }}</td>

                    <td>
                        {{ $row->bahanbaku->namabahan ?? '-' }}
                    </td>

                    <td>{{ $row->jumlah }}</td>

                    <td>{{ $row->tanggalkeluar }}</td>

                    <td>{{ $row->alasan }}</td>

                    <td>

                        <a href="{{ route('inventory.stokkeluar.show', $row->id) }}"
                           class="btn btn-info btn-sm">
                            Show
                        </a>

                        <a href="{{ route('inventory.stokkeluar.edit', $row->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('inventory.stokkeluar.destroy', $row->id) }}"
                              method="POST"
                              style="display:inline-block;">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    onclick="return confirm('Yakin hapus data?')"
                                    class="btn btn-danger btn-sm">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6"
                        class="text-center">

                        Data stok keluar kosong

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection