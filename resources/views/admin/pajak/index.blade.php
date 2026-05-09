@extends('layouts.appadmin')

@section('title', 'Data Pajak')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Pajak</h4>

        <a href="{{ route('master.pajak.create') }}"
           class="btn btn-dark">
            + Tambah Pajak
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

                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama Pajak</th>
                        <th>Persen</th>
                        <th>Status</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->namapajak }}</td>

                        <td>{{ $item->persen }}%</td>

                        <td>
                            @if($item->status == 'aktif')
                                <span class="badge bg-success">
                                    AKTIF
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    NONAKTIF
                                </span>
                            @endif
                        </td>

                        <td>

                            <a href="{{ route('master.pajak.show', $item->id) }}"
                               class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <a href="{{ route('master.pajak.edit', $item->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('master.pajak.destroy', $item->id) }}"
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
                        <td colspan="5" class="text-center">
                            Data pajak kosong
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection