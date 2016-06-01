@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Editar aula</h2>
    {{ Form::model($aula, array('method' => 'PATCH', 'action' => array('AulaController@update', 'turma' => $turma->id, 'aula' => $aula->id))) }}
        @include('aula._form', array('submitButtonText' => 'Atualizar Aula'))
    {{ Form::close() }}

@endsection