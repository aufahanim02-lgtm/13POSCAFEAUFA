@extends('layouts.appadmin')



@section('content')



    <section class="content-header">
        <div class="container-fluid">
            <h1>Riwayat Transaksi</h1>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-primary card-outline">

                <div class="card-header">
                    <h3 class="card-title">
                        Semua Transaksi Kasir
                    </h3>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-bordered table-striped">

                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Invoice</th>
                                <th>Kasir</th>
                                <th>Meja</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th width="120">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($data as $row)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $row->kodeinvoice }}
                                </td>

                                <td>
                                    {{ $row->user->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $row->meja->nomormeja ?? '-' }}
                                </td>

                                <td>
                                    Rp {{ number_format($row->total,0,',','.') }}
                                </td>

                                <td>

                                    @if($row->status == 'paid')

                                        <span class="badge badge-success">
                                            PAID
                                        </span>

                                    @else

                                        <span class="badge badge-warning">
                                            PENDING
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    {{ $row->tanggalpenjualan }}
                                </td>

                                <td>

                                    <a href="{{ route('transaksi.riwayat.show',$row->id) }}"
                                        class="btn btn-info btn-sm">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="8"
                                    class="text-center text-muted">

                                    Belum ada transaksi

                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </section>

</div>

@endsection