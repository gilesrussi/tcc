@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Html::image($user->avatar) }}
        {{ $user->name }}
        {{ Form::open(array('method' => 'POST')) }}
            {{ Form::hidden('user_id', $user->id) }}
            {{ Form::submit('Adicionar como amigo') }}
        {{ Form::close() }}

    </div>
@endsection