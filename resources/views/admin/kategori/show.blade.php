@extends('layouts.appadmin')



@section('content')

<div class="container-fluid">

    <div class="card shadow-sm border-0">

        <div class="card-header bg-info text-white">

            <h5 class="mb-0">
                Detail Kategori
            </h5>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="25%">ID</th>
                    <td>{{ $kategori->id }}</td>
                </tr>

                <tr>
                    <th>Nama Kategori</th>
                    <td>{{ $kategori->namakategori }}</td>
                </tr>

                <tr>
                    <th>Deskripsi</th>
                    <td>{{ $kategori->deskripsi }}</td>
                </tr>

            </table>

            <div class="mt-4">

                <a href="{{ route('master.kategori.edit', $kategori->id) }}"
                    class="btn btn-warning">
                    Edit
                </a>

                <a href="{{ route('master.kategori.index') }}"
                    class="btn btn-secondary">
                    Kembali
                </a>

            </div>

        </div>

    </div>

</div>

@endsection