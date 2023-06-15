<!doctype html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="author" content="John Doe">
    <meta name="description" content="">
    <meta name="keywords" content="HTML,CSS,XML,JavaScript">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" value="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>

    <script src="{{ asset('asset/js/4n2NXumNjtg5LPp6VXLlDicTUfA.js') }}"></script>
    <link rel="apple-touch-icon" href="{{ asset('asset/images/apple-touch-icon.html') }}">
    <link rel="shortcut icon" type="image/ico" href="{{ asset('asset/images/favicon.html') }}" />

    <link rel="stylesheet" href="{{ asset('asset/css/bootstrap.min.css') }}">

    <link href="{{ asset('asset/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('asset/css/matrialize.css') }}" rel="stylesheet">

    <link href="{{ asset('asset/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">

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
    {{-- header --}}
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

    <div class="modal" id="myModal">
        <div class="container">
            <div class="vertical-space-85"></div>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-body">
                        <button class="button button-rounded  close" data-dismiss="modal">&times;</button>
                        <video class="" controls>
                            <source src="{{ asset('asset/video/Pexels_Videos_2706.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script data-cfasync="false" src="{{ asset('asset/js/email-decode.min.js') }}"></script>
    <script src="{{ asset('asset/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/user.js') }}?t={{ time() }}" defer></script>
    <script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('asset/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('asset/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('asset/js/custom.js') }}"></script>
</body>

</html>
