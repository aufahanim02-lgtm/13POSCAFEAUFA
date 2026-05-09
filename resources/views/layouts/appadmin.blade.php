<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - CAFEPOS</title>

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <style>
        body {
            font-family: "Poppins", sans-serif;
        }

        .brand-link {
            font-weight: bold;
            font-size: 18px;
        }

        .content-wrapper {
            padding-bottom: 20px;
        }
    </style>

    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.admin.navbar')

        <!-- Sidebar -->
        @include('layouts.admin.sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">

            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">@yield('title')</h1>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>

        </div>

        <!-- Footer -->
        @include('layouts.admin.footer')

    </div>

    <!-- AdminLTE JS -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('[data-widget="treeview"]').Treeview('init');
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const treeviews = document.querySelectorAll('.has-treeview > a');

            treeviews.forEach(function(menu) {

                menu.addEventListener('click', function(e) {

                    e.preventDefault();

                    let parent = this.parentElement;

                    parent.classList.toggle('menu-open');

                    let link = this;

                    link.classList.toggle('active');

                });

            });

        });
    </script>
</body>

</html>