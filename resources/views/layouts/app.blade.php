<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>COED
    @yield('title-complement')
    </title>

    <!-- Fonts -->
    <link href="/css/all.css" rel='stylesheet' type='text/css'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/css/select2.min.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }
    </style>
</head>
<body id="app-layout">
    @include('layouts.topbar')
    <div class="container">
        @yield('content')
    </div>
    <footer class="footer">
        <div class="container">
            <p class="text-muted text-center">
                Universidade Federal de Santa Maria<br>
                Trabalho de Conclusão do Curso de Sistemas de Informação<br>
                Desenvolvido por Gilberto Fortunato Russi, usando Laravel
            </p>
        </div>
    </footer>
    <!-- JavaScripts -->
    <script src="/js/all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>
    @yield('footer')
    {!! Toastr::render() !!}
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
