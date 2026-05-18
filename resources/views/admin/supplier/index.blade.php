@extends('layouts.appadmin')



@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Supplier</h4>

        <a href="{{ route('master.supplier.create') }}"
           class="btn btn-primary">
            + Tambah Supplier
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
                        <th width="5%">No</th>
                        <th>Nama Supplier</th>
                        <th>No HP</th>
                        <th>Alamat</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->namasupplier }}</td>

                        <td>{{ $item->nohp ?? '-' }}</td>

                        <td>{{ $item->alamat ?? '-' }}</td>

                        <td>

                            <a href="{{ route('master.supplier.show', $item->id) }}"
                               class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <a href="{{ route('master.supplier.edit', $item->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('master.supplier.destroy', $item->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus supplier?')">

                                    Hapus

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            Data supplier masih kosong
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection