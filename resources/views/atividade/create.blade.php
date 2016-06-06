@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Criar atividade</h2>
    {{ Form::open(array('action' => array('AtividadeController@store', $turma->id))) }}
        @include('atividade._form', array(
            'submitButtonText' => 'Criar Atividade',
            'tipo_atividade' => $tipo_atividade
         ))
    {{ Form::close() }}

@endsection