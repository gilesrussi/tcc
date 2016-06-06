@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Adicionar nota para {{ $atividade->header }}</h2>
    {{ Form::open(array('action' => array('NotaController@store', $turma->id, $atividade->id))) }}
        @include('nota._form', array('submitButtonText' => 'Adicionar Nota'))
    {{ Form::close() }}

@endsection