@extends('home.layout')

@section('inner-content')
    <div class="panel panel-default">
        <div class="panel-heading">{{ Auth::user()->name }}</div>

        <div class="panel-body">
            {{ Html::image(Auth::user()->avatar) }}
        </div>
    </div>
@endsection
