@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Editar atividade</h2>
    {{ Form::model($atividade, array('method' => 'PATCH', 'action' => array('AtividadeController@update', 'turma' => $turma->id, 'atividade' => $atividade->id))) }}
        @include('atividade._form', array(
            'submitButtonText' => 'Atualizar Atividade',
            'tipo_atividade' => $tipo_atividade
        ))
    {{ Form::close() }}

@endsection