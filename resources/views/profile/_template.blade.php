@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Html::image($user->avatar) }}
        {{ $user->name }}
        @yield('headerButtons')
    </div>
@endsection