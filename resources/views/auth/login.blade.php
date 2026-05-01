@extends('layouts.appguest')

@section('title', 'Login')

@section('content')
<section class="py-5" style="margin-top:90px;">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            
            <div class="col-lg-5 col-md-7" data-aos="zoom-in">
                <div class="glass-card">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-warning">
                            <i class="fa-solid fa-mug-hot"></i> CAFEPOS
                        </h2>
                        <p class="text-white-50 mb-0">
                            Silakan login untuk masuk ke sistem kasir
                        </p>
                    </div>

                    <!-- Alert Error -->
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Alert Success -->
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fa-solid fa-circle-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('auth.loginproses') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input type="text" name="username"
                                class="form-control bg-dark text-white border-0"
                                placeholder="Masukkan username" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" id="password"
                                    class="form-control bg-dark text-white border-0"
                                    placeholder="Masukkan password" required>

                                <button type="button" class="btn btn-outline-light border-0" onclick="togglePassword()">
                                    <i class="fa-solid fa-eye" id="iconEye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember">
                                <label class="form-check-label text-white-50" for="remember">
                                    Remember me
                                </label>
                            </div>

                            <a href="#" class="text-warning text-decoration-none">
                                Lupa password?
                            </a>
                        </div>

                        <button type="submit" class="btn btn-gradient w-100 py-2 rounded-pill">
                            <i class="fa-solid fa-right-to-bracket"></i> Login
                        </button>

                        <div class="text-center mt-4">
                            <p class="text-white-50 mb-0">
                                Kembali ke halaman
                                <a href="{{ url('/') }}" class="text-warning text-decoration-none fw-bold">
                                    Landing Page
                                </a>
                            </p>
                        </div>
                    </form>

                    <hr class="border-secondary mt-4">

                    <div class="text-center">
                        <small class="text-white-50">
                            Login sesuai role: <b>Owner</b>, <b>Manager</b>, <b>Kasir</b>
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@push('scripts')
<script>
    function togglePassword() {
        let password = document.getElementById("password");
        let iconEye = document.getElementById("iconEye");

        if (password.type === "password") {
            password.type = "text";
            iconEye.classList.remove("fa-eye");
            iconEye.classList.add("fa-eye-slash");
        } else {
            password.type = "password";
            iconEye.classList.remove("fa-eye-slash");
            iconEye.classList.add("fa-eye");
        }
    }
</script>
@endpush
@endsection