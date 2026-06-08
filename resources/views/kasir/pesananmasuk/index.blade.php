@extends('layouts.appkasir')

@section('title', 'Pesanan Masuk')

@section('content')

{{-- AUDIO NOTIF --}}
<audio id="notifSound">
    <source src="{{ asset('sound/pesanmasuk.mp3') }}" type="audio/mpeg">
</audio>

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">📥 Pesanan Masuk Pelanggan</h3>

        {{-- TEST SOUND --}}
        <button onclick="testSound()" class="btn btn-primary btn-sm">
            🔊 Test Sound
        </button>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <b>Berhasil!</b> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger">
        <b>Error!</b> {{ session('error') }}
    </div>
    @endif

    <div class="card shadow-sm border-0">

        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">
                <i class="fas fa-receipt"></i>
                Daftar Pesanan Masuk
            </h5>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead class="table-dark text-center">
                    <tr>
                        <th width="50">No</th>
                        <th>Kode Invoice</th>
                        <th>Pelanggan</th>
                        <th>Meja</th>
                        <th>Total</th>
                        <th>Status Pesanan</th>
                        <th>Status Bayar</th>
                        <th width="260">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($data as $row)

                    <tr>

                        <td class="text-center">
                            {{ $loop->iteration }}
                        </td>

                        <td class="fw-bold text-warning">
                            {{ $row->kodeinvoice }}
                        </td>

                        <td>
                            {{ $row->pelanggan->name ?? '-' }}
                        </td>

                        <td class="text-center">
                            @if($row->meja)
                            <span class="badge bg-info">
                                Meja {{ $row->meja->nomormeja }}
                            </span>
                            @else
                            -
                            @endif
                        </td>

                        <td class="fw-bold text-success">
                            Rp {{ number_format($row->total,0,',','.') }}
                        </td>

                        <td class="text-center">

                            @if($row->statuspesanan == 'menunggu')

                            <span class="badge bg-warning text-dark px-3 py-2">
                                MENUNGGU
                            </span>

                            @elseif($row->statuspesanan == 'diproses')

                            <span class="badge bg-primary px-3 py-2">
                                DIPROSES
                            </span>

                            @elseif($row->statuspesanan == 'siapdiambil')

                            <span class="badge bg-success px-3 py-2">
                                SIAP DIAMBIL
                            </span>

                            @elseif($row->statuspesanan == 'selesai')

                            <span class="badge bg-dark px-3 py-2">
                                SELESAI
                            </span>

                            @else

                            <span class="badge bg-danger px-3 py-2">
                                DIBATALKAN
                            </span>

                            @endif

                        </td>

                        <td class="text-center">

                            @if($row->statuspembayaran == 'belumbayar')

                            <span class="badge bg-danger px-3 py-2">
                                BELUM BAYAR
                            </span>

                            @else

                            <span class="badge bg-success px-3 py-2">
                                LUNAS
                            </span>

                            @endif

                        </td>

                        <td class="text-center">

                            {{-- DETAIL --}}
                            <a href="{{ route('kasir.pesananmasuk.show', $row->id) }}"
                                class="btn btn-secondary btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>

                            {{-- MENUNGGU --}}
                            @if($row->statuspesanan == 'menunggu')

                            <form action="{{ route('kasir.pesananmasuk.diproses', $row->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                <button class="btn btn-success btn-sm"
                                    onclick="return confirm('Proses pesanan ini?')">

                                    <i class="fas fa-check"></i>

                                </button>

                            </form>

                            <form action="{{ route('kasir.pesananmasuk.batalkan', $row->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Batalkan pesanan ini?')">

                                    <i class="fas fa-times"></i>

                                </button>

                            </form>

                            @endif

                            {{-- DIPROSES --}}
                            @if($row->statuspesanan == 'diproses')

                            <form action="{{ route('kasir.pesananmasuk.siap', $row->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                <button class="btn btn-warning btn-sm"
                                    onclick="return confirm('Pesanan siap diambil?')">

                                    <i class="fas fa-box"></i>
                                    siap diambil

                                </button>

                            </form>

                            @endif

                            {{-- SIAP --}}
                            @if($row->statuspesanan == 'siapdiambil' && $row->statuspembayaran == 'lunas')

                            <form action="{{ route('kasir.pesananmasuk.selesai', $row->id) }}"
                                method="POST"
                                class="d-inline">

                                @csrf

                                <button class="btn btn-dark btn-sm"
                                    onclick="return confirm('Selesaikan pesanan?')">

                                    <i class="fas fa-flag-checkered"></i>

                                </button>

                            </form>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            Tidak ada pesanan masuk.
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>
    </div>

</div>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // =========================================
    // AUDIO
    // =========================================
    const notifSound = document.getElementById('notifSound');

    // =========================================
    // LAST ORDER ID
    // =========================================
    let lastOrderId = localStorage.getItem('lastOrderId') || 0;

    // =========================================
    // FIRST LOAD
    // =========================================
    let firstLoad = true;

    // =========================================
    // CEK PESANAN BARU
    // =========================================
    function cekPesananBaru() {
        fetch("{{ route('kasir.cekpesanan') }}")

            .then(response => response.json())

            .then(data => {

                let currentId = parseInt(data.lastid);

                // =====================================
                // PERTAMA KALI LOAD
                // JANGAN BUNYI
                // =====================================
                if (firstLoad) {
                    localStorage.setItem('lastOrderId', currentId);

                    lastOrderId = currentId;

                    firstLoad = false;

                    return;
                }

                // =====================================
                // ADA PESANAN BARU
                // =====================================
                if (currentId > parseInt(lastOrderId)) {
                    // UPDATE STORAGE
                    localStorage.setItem('lastOrderId', currentId);

                    // UPDATE VARIABLE
                    lastOrderId = currentId;

                    // RESET AUDIO
                    notifSound.pause();

                    notifSound.currentTime = 0;

                    notifSound.loop = false;

                    // PLAY SEKALI
                    notifSound.play()

                        .then(() => {

                            console.log('Sound notif dimainkan');

                        })

                        .catch((err) => {

                            console.log('Autoplay diblokir browser');

                        });

                    // POPUP
                    Swal.fire({

                        icon: 'success',

                        title: 'Pesanan Baru!',

                        text: 'Ada pesanan pelanggan masuk.',

                        timer: 3000,

                        showConfirmButton: false

                    });

                    // RELOAD
                    setTimeout(() => {

                        location.reload();

                    }, 2000);
                }

            })

            .catch(error => {

                console.log(error);

            });
    }

    // =========================================
    // AUTO CHECK
    // =========================================
    setInterval(cekPesananBaru, 3000);

    // =========================================
    // LOAD PERTAMA
    // =========================================
    cekPesananBaru();

    // =========================================
    // TEST SOUND
    // =========================================
    function testSound() {
        notifSound.pause();

        notifSound.currentTime = 0;

        notifSound.loop = false;

        notifSound.play();
    }
</script>

@endsection