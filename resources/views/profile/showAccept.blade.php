
@extends('profile._template')

@section('headerButtons')
    {{ Form::open(array('method' => 'POST')) }}
        {{ Form::hidden('user_id', $user->id) }}
        {{ Form::hidden('aceitar', 1) }}
        {{ Form::submit('Aceitar amigo') }}
    {{ Form::close() }}
    {{ Form::open(array('method' => 'POST')) }}
        {{ Form::hidden('user_id', $user->id) }}
        {{ Form::hidden('aceitar', 0) }}
        {{ Form::submit('Não aceitar amigo') }}
    {{ Form::close() }}
@endsection