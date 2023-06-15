<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" value="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Vue App</title>
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

<body>
    <div id="app">
        <example-component></example-component>
    </div>
    <script src="{{ asset('js/employer.js') }}?t={{ time() }}" defer></script>
</body>

</html>
