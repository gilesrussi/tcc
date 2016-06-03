@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Editar anotação para {{ $aula->header }}</h2>
    {{ Form::model($anotacao, array('method' => 'PATCH', 'action' => array('AnotacaoController@update', 'turma' => $turma->id, 'aula' => $aula->id))) }}
        @include('anotacao._form', array('submitButtonText' => 'Atualizaar Anotação'))
    {{ Form::close() }}

@endsection