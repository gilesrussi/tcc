<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="/css/all.css" rel='stylesheet' type='text/css'>
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    @include('layouts.topbar')

    @yield('content')

    <!-- JavaScripts -->
    <script src="/js/all.js"></script>
    {!! Toastr::render() !!}
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
