@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Adicionar anotação para {{ $aula->header }}</h2>
    {{ Form::open(array('action' => array('AnotacaoController@store', $turma->id, $aula->id))) }}
        @include('anotacao._form', array('submitButtonText' => 'Criar anotação'))
    {{ Form::close() }}

@endsection