<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Manager') - CAFEPOS</title>

    <!-- GOOGLE FONT -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- ADMINLTE CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- NAVBAR -->
        @include('layouts.manager.navbar')

        <!-- SIDEBAR -->
        @include('layouts.manager.sidebar')

        <!-- CONTENT -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- FOOTER -->
        @include('layouts.manager.footer')

    </div>

    <!-- ADMINLTE JS -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    @stack('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const treeviews = document.querySelectorAll('.has-treeview > a');

            treeviews.forEach(function(menu) {

                menu.addEventListener('click', function(e) {

                    e.preventDefault();

                    let parent = this.parentElement;

                    parent.classList.toggle('menu-open');

                    this.classList.toggle('active');

                });

            });

        });
    </script>
</body>

</html>