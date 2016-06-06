@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Atualizar nota para {{ $atividade->header }}</h2>
    {{ Form::model($nota, array('method' => 'PATCH', 'action' => array('NotaController@update', 'turma' => $turma->id, 'atividade' => $atividade->id))) }}
        @include('nota._form', array('submitButtonText' => 'Atualizar Nota'))
    {{ Form::close() }}

@endsection