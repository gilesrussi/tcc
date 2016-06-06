@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Cadastrar Material</h2>
    {{ Form::open(array('action' => array('MaterialController@store', $turma->id), 'files' => true)) }}
        @include('material._form', array(
            'submitButtonText' => 'Criar Material',
         ))
    {{ Form::close() }}

@endsection