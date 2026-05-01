<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAFEPOS - @yield('title')</title>

    <link rel="icon" href="{{ asset('foto/banner/logo.png') }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #0b0f19;
            color: white;
        }

        .navbar-blur {
            background: rgba(10, 15, 25, 0.75);
            backdrop-filter: blur(10px);
        }

        .btn-gradient {
            background: linear-gradient(90deg, #ff4d4d, #ff8c42);
            border: none;
            color: white;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-gradient:hover {
            transform: translateY(-3px);
            box-shadow: 0px 10px 25px rgba(255, 120, 80, 0.4);
        }

        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: radial-gradient(circle at top left, rgba(255,77,77,0.25), transparent 50%),
                        radial-gradient(circle at bottom right, rgba(255,140,66,0.25), transparent 50%);
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            line-height: 1.2;
        }

        .hero-subtitle {
            color: rgba(255,255,255,0.75);
            font-size: 1.1rem;
        }

        .glass-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 18px;
            padding: 25px;
            backdrop-filter: blur(10px);
            transition: 0.3s;
        }

        .glass-card:hover {
            transform: translateY(-8px);
            box-shadow: 0px 15px 40px rgba(0,0,0,0.4);
        }

        .section-title {
            font-weight: 800;
            font-size: 2rem;
        }

        footer {
            background: rgba(0,0,0,0.6);
            border-top: 1px solid rgba(255,255,255,0.08);
        }
    </style>

    @stack('styles')
</head>
<body>

    @include('layouts.guest.navbar')

    <main>
        @yield('content')
    </main>

    @include('layouts.guest.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

    @stack('scripts')

</body>
</html>