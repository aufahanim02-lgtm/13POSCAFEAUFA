@extends('layouts.appmanager')

@section('title', 'Data Bahan Baku')

@section('content')

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h3 class="card-title">
            Data Bahan Baku
        </h3>

        <a href="{{ route('inventory.bahanbaku.create') }}"
            class="btn btn-primary btn-sm">

            <i class="fas fa-plus"></i>
            Tambah Bahan Baku

        </a>

    </div>

    <div class="card-body">

        @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

        @endif

        @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

        @endif

        <div class="table-responsive">

            <table class="table table-bordered table-striped">

                <thead class="table-dark">

                    <tr>

                        <th width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama Bahan</th>
                        <th>Stok</th>
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th width="18%">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($data as $no => $row)

                    <tr>

                        <td>
                            {{ $no + 1 }}
                        </td>

                        <td>
                            {{ $row->kodebahan }}
                        </td>

                        <td>
                            {{ $row->namabahan }}
                        </td>

                        <td>
                            {{ $row->stok }}
                        </td>

                        <td>
                            {{ $row->satuan }}
                        </td>

                        <td>
                            Rp {{ number_format($row->hargabeli,0,',','.') }}
                        </td>

                        <td>

                            <a href="{{ route('inventory.bahanbaku.show', $row->id) }}"
                                class="btn btn-info btn-sm">

                                <i class="fas fa-eye"></i>

                            </a>

                            <a href="{{ route('inventory.bahanbaku.edit', $row->id) }}"
                                class="btn btn-warning btn-sm">

                                <i class="fas fa-edit"></i>

                            </a>

                            <form action="{{ route('inventory.bahanbaku.destroy', $row->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    onclick="return confirm('Yakin hapus data?')"
                                    class="btn btn-danger btn-sm">

                                    <i class="fas fa-trash"></i>

                                </button>
                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7"
                            class="text-center">

                            Data bahan baku belum tersedia

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection