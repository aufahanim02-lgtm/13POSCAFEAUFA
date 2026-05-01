@extends('layouts.appguest')

@section('title', 'Kontak')

@section('content')
<section class="py-5" style="margin-top:90px;">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Kontak Kami</h2>
            <p class="text-white-50">
                Hubungi kami untuk pertanyaan, kerja sama, atau informasi lebih lanjut.
            </p>
        </div>

        <div class="row g-4">
            <!-- Form Kontak -->
            <div class="col-lg-7" data-aos="fade-right">
                <div class="glass-card">
                    <h4 class="fw-bold text-warning mb-4">
                        <i class="fa-solid fa-envelope"></i> Kirim Pesan
                    </h4>

                    <form action="#" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control bg-dark text-white border-0"
                                   placeholder="Masukkan nama anda" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control bg-dark text-white border-0"
                                   placeholder="Masukkan email anda" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Subjek</label>
                            <input type="text" name="subjek" class="form-control bg-dark text-white border-0"
                                   placeholder="Masukkan subjek" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea name="pesan" rows="5" class="form-control bg-dark text-white border-0"
                                      placeholder="Tulis pesan anda..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-gradient px-4 py-2 rounded-pill">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

            <!-- Info Kontak -->
            <div class="col-lg-5" data-aos="fade-left">
                <div class="glass-card">
                    <h4 class="fw-bold text-warning mb-4">
                        <i class="fa-solid fa-location-dot"></i> Informasi Kontak
                    </h4>

                    <p class="text-white-50 mb-2">
                        <i class="fa-solid fa-map"></i> Indonesia
                    </p>

                    <p class="text-white-50 mb-2">
                        <i class="fa-solid fa-phone"></i> +62 812-xxxx-xxxx
                    </p>

                    <p class="text-white-50 mb-2">
                        <i class="fa-solid fa-envelope"></i> cafepos@gmail.com
                    </p>

                    <hr class="border-secondary">

                    <h5 class="fw-bold">Jam Operasional</h5>
                    <p class="text-white-50 mb-0">Senin - Minggu</p>
                    <p class="text-white-50">08:00 - 23:00</p>

                    <div class="d-flex gap-3 mt-4">
                        <a href="#" class="text-white fs-4"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#" class="text-white fs-4"><i class="fa-brands fa-tiktok"></i></a>
                    </div>
                </div>

                <div class="glass-card mt-4 text-center" data-aos="zoom-in">
                    <h5 class="fw-bold">Butuh Demo Aplikasi?</h5>
                    <p class="text-white-50">
                        Silakan login sebagai kasir untuk melihat tampilan dashboard.
                    </p>
                    <a href="{{ url('/login') }}" class="btn btn-gradient rounded-pill w-100">
                        <i class="fa-solid fa-right-to-bracket"></i> Login Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection