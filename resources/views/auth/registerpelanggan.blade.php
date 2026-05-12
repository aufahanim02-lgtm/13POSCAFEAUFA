@extends('layouts.appguest')

@section('title', 'Register Pelanggan')

@section('content')
<section class="py-5" style="margin-top:90px;">
    <div class="container">
        <div class="row justify-content-center align-items-center">

            <div class="col-lg-6 col-md-8">
                <div class="glass-card">

                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-warning">
                            <i class="fa-solid fa-mug-hot"></i> CAFEPOS
                        </h2>
                        <p class="text-white-50 mb-0">
                            Daftar akun pelanggan untuk mulai memesan menu cafe
                        </p>
                    </div>

                    {{-- ERROR --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('pelanggan.register.proses') }}" method="POST">
                        @csrf

                        {{-- NAME --}}
                        <div class="mb-3">
                            <label class="form-label text-white">Nama Lengkap</label>
                            <input type="text" name="name"
                                class="form-control bg-dark text-white border-0"
                                value="{{ old('name') }}"
                                required>
                        </div>

                        {{-- USERNAME --}}
                        <div class="mb-3">
                            <label class="form-label text-white">Username</label>
                            <input type="text" name="username"
                                class="form-control bg-dark text-white border-0"
                                value="{{ old('username') }}"
                                required>
                        </div>

                        {{-- NO HP --}}
                        <div class="mb-3">
                            <label class="form-label text-white">No HP</label>
                            <input type="text" name="nohp"
                                class="form-control bg-dark text-white border-0"
                                value="{{ old('nohp') }}">
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label class="form-label text-white">Email</label>
                            <input type="email" name="email"
                                class="form-control bg-dark text-white border-0"
                                value="{{ old('email') }}"
                                required>
                        </div>

                        {{-- PASSWORD --}}
                        <div class="mb-3">
                            <label class="form-label text-white">Password</label>
                            <input type="password" name="password"
                                class="form-control bg-dark text-white border-0"
                                required>
                        </div>

                        <button class="btn btn-success w-100">
                            Register
                        </button>

                    </form>

                    <div class="text-center mt-3">
                        <a href="{{ route('pelanggan.login') }}" class="text-warning">
                            Sudah punya akun? Login
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection