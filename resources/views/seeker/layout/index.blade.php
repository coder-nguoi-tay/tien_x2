<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>user</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('employer/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('employer/css/styles.min.css') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="{{ asset('js/user.js') }}?t={{ time() }}" defer></script>
    

    <script>
        window.Laravel = {!! json_encode(
            [
                'csrfToken' => csrf_token(),
                'baseUrl' => url('/'),
            ],
            JSON_UNESCAPED_UNICODE,
        ) !!};
    </script>
</head>

<body id="app">
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        @include('seeker.layout.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            @include('seeker.layout.header')
            <!--  Header End -->
            <div class="container-fluid">
                @if (session()->get('Message.flash'))
                    <notyf :data="{{ json_encode(session()->get('Message.flash')[0]) }}"></notyf>
                @endif
                @php
                    session()->forget('Message.flash');
                @endphp
                <!--  Row 1 -->
                @yield('main-seeker')
                <div class="py-6 px-6 text-center">
                    <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
                            class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a
                            href="https://themewagon.com">ThemeWagon</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('employer/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('employer/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('employer/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('employer/js/app.min.js') }}"></script>
    <script src="{{ asset('employer/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('employer/libs/simplebar/dist/simplebar.js') }}"></script>
    <script src="{{ asset('employer/js/dashboard.js') }}"></script>
    <script src="{{ asset('asset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('asset/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('asset/js/demo/datatables-demo.js') }}"></script>
</body>

</html>
