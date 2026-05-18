@extends('layouts.appadmin')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
       

        <a href="{{ route('master.promo.create') }}"
           class="btn btn-primary">
            + Tambah Promo
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
                        <th>No</th>
                        <th>Nama Promo</th>
                        <th>Jenis</th>
                        <th>Diskon</th>
                        <th>Minimal Belanja</th>
                        <th>Status</th>
                        <th width="25%">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $item)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $item->namapromo }}</td>

                        <td>{{ strtoupper($item->jenis) }}</td>

                        <td>{{ $item->nilaidiskon }}</td>

                        <td>
                            Rp {{ number_format($item->minimalbelanja,0,',','.') }}
                        </td>

                        <td>
                            @if($item->status == 'aktif')
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

                            <a href="{{ route('master.promo.show', $item->id) }}"
                               class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <a href="{{ route('master.promo.edit', $item->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('master.promo.destroy', $item->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus promo?')">
                                    Hapus
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center">
                            Data promo kosong
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

@endsection