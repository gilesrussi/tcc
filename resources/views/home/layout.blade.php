@extends('layouts.app')

@section('title')
    - Home
@endsection

@section('content')
    @include('home.sidebar')

    <div class="col-md-8">
        @yield('inner-content')
    </div>

@endsection