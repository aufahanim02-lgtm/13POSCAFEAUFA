@extends('layouts.appguest')

@section('title', 'Login Pelanggan')

@section('content')

<style>
    body {
        background: #f4f6f9;
    }

    .glass-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        border: 1px solid #e5e7eb;
    }

    .form-control {
        height: 48px;
        border-radius: 12px;
        border: 1px solid #d1d5db;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #f59e0b;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #f59e0b, #f97316);
        border: none;
        color: white;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-gradient:hover {
        opacity: 0.9;
        color: white;
        transform: translateY(-1px);
    }

    .login-title {
        color: #111827;
    }

    .login-subtitle {
        color: #6b7280;
    }

    .text-link {
        color: #f59e0b;
        text-decoration: none;
        font-weight: 600;
    }

    .text-link:hover {
        color: #ea580c;
    }

    .login-footer {
        color: #6b7280;
    }
</style>

<section class="py-5" style="margin-top:90px;">
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-lg-5 col-md-7">

                <div class="glass-card">

                    {{-- HEADER --}}
                    <div class="text-center mb-4">
                        <h2 class="fw-bold login-title">
                            <i class="fa-solid fa-mug-hot text-warning"></i>
                            CAFEPOS
                        </h2>

                        <p class="login-subtitle mb-0">
                            Silakan login untuk masuk sebagai pelanggan
                        </p>
                    </div>

                    {{-- ALERT ERROR --}}
                    @if(session('error'))
                        <div class="alert alert-danger">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- ALERT SUCCESS --}}
                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="fa-solid fa-circle-check"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- VALIDATION ERROR --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <i class="fa-solid fa-triangle-exclamation"></i>

                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM --}}
                    <form action="{{ route('pelanggan.login.proses') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">
                                Username
                            </label>

                            <input type="text"
                                   name="username"
                                   value="{{ old('username') }}"
                                   class="form-control"
                                   placeholder="Masukkan username"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-dark">
                                Password
                            </label>

                            <div class="input-group">

                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="form-control"
                                       placeholder="Masukkan password"
                                       required>

                                <button type="button"
                                        class="btn btn-outline-secondary"
                                        onclick="togglePassword()">

                                    <i class="fa-solid fa-eye" id="iconEye"></i>

                                </button>

                            </div>
                        </div>

                        <button type="submit"
                                class="btn btn-gradient w-100 py-2 rounded-pill">

                            <i class="fa-solid fa-right-to-bracket"></i>
                            Login Pelanggan

                        </button>

                        {{-- LINK --}}
                        <div class="text-center mt-4">

                            <p class="login-footer mb-1">
                                Belum punya akun?
                                <a href="{{ route('pelanggan.register') }}"
                                   class="text-link">
                                    Daftar Sekarang
                                </a>
                            </p>

                            <p class="login-footer mt-2 mb-0">
                                Kembali ke
                                <a href="{{ url('/') }}"
                                   class="text-link">
                                    Landing Page
                                </a>
                            </p>

                        </div>

                    </form>

                    <hr class="mt-4">

                    {{-- FOOTER --}}
                    <div class="text-center">
                        <small class="login-footer">
                            Login pelanggan digunakan untuk memesan menu cafe secara online.
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