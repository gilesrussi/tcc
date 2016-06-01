@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Criar aula</h2>
    {{ Form::open(array('action' => array('AulaController@store', $turma->id))) }}
        @include('aula._form', array('submitButtonText' => 'Criar Aula'))
    {{ Form::close() }}

@endsection