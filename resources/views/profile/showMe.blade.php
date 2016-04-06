@extends('profile._template')

@section('headerButtons')
    {{ Form::button('Editar perfil', array('onclick' => 'location.href = "edit"')) }}
@endsection