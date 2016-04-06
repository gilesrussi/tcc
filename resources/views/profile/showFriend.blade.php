@extends('profile._template')

@section('headerButtons')
    {{ Form::open(array('method' => 'POST')) }}
        {{ Form::hidden('user_id', $user->id) }}
        {{ Form::submit('Remover dos amigos') }}
    {{ Form::close() }}
@endsection