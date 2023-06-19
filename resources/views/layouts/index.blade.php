<!DOCTYPE html>
<html>

<!-- Mirrored from creativelayers.net/themes/jobhunt-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Jun 2023 05:37:28 GMT -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="CreativeLayers">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap-grid.css') }}" />
    <link rel="stylesheet" href="{{ asset('home/css/icons.css') }}">
    <link rel="stylesheet" href="{{ asset('home/css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/responsive.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/chosen.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/colors/colors.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('home/maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
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

    <div class="page-loading">
        <img src="{{ asset('home/images/loader.gif') }}" alt="" />
    </div>

    <div class="theme-layout" id="scrollup">

        {{-- head --}}
        @include('layouts.header')
        @if (session()->get('Message.flash'))
            <notyf :data="{{ json_encode(session()->get('Message.flash')[0]) }}"></notyf>
        @endif
        @php
            session()->forget('Message.flash');
        @endphp
        @yield('home')

        {{-- footer --}}
        @include('layouts.footer')
    </div>

    <script src="{{ asset('js/user.js') }}?t={{ time() }}" defer></script>
    <script src="{{ asset('home/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/js/modernizr.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/js/script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/js/wow.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/js/slick.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/js/parallax.js') }}" type="text/javascript"></script>
    <script src="{{ asset('home/js/select-chosen.js') }}" type="text/javascript"></script>

</body>

<!-- Mirrored from creativelayers.net/themes/jobhunt-html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 18 Jun 2023 05:37:35 GMT -->

</html>
