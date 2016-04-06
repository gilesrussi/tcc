@extends('profile._template')

@section('headerButtons')
    {{ Form::hidden('user_id', $user->id) }}
    {{ Form::submit('Adicionar como amigo') }}
@endsection