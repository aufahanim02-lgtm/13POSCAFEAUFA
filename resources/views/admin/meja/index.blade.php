@extends('layouts.appadmin')



@section('content')

<div class="content-header">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0">Data Meja</h1>
            <small class="text-muted">Daftar meja cafe/restoran</small>
        </div>

        <a href="{{ route('master.meja.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Meja
        </a>
    </div>
</div>

<section class="content">
    <div class="container-fluid">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            @forelse($data as $row)
            <div class="col-md-3">
                <div class="card text-center shadow-sm">
                    <div class="card-body">
                        <h4 class="mb-2">{{ $row->nomormeja }}</h4>

                        <p class="mb-2">
                            Kapasitas: <b>{{ $row->kapasitas }}</b>
                        </p>

                        @if($row->status == 'kosong')
                            <span class="badge badge-success">Kosong</span>
                        @elseif($row->status == 'terisi')
                            <span class="badge badge-danger">Terisi</span>
                        @else
                            <span class="badge badge-secondary">{{ $row->status }}</span>
                        @endif

                        <hr>

                        <a href="{{ route('master.meja.show', $row->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>

                        <a href="{{ route('master.meja.edit', $row->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('master.meja.destroy', $row->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus meja ini?')" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Data meja masih kosong.
                </div>
            </div>
            @endforelse
        </div>

    </div>
</section>

@endsection