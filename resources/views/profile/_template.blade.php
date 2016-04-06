@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Html::image($user->avatar) }}
        {{ $user->name }}
        {{ Form::open(array('method' => 'POST')) }}
        @yield('headerButtons')

        {{ Form::close() }}

    </div>
@endsection