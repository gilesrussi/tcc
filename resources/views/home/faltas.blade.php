@extends('home.layout')

@section('inner-content')
    <h2>Minhas faltas</h2>
    @forelse($turmas as $turma)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ link_to_action('TurmaController@show', $turma->cid->disciplina->nome, array('turma' => $turma->id)) }}
            </div>
            <div class="panel-body">
                Faltas:
                {{ $turma->aulas->filter(function ($aula) { return (bool)$aula->ausencias->count(); })->count() }}
                /
                {{ $turma->aulas->count() }} ({{ link_to_action('FaltaController@index', 'Clique aqui para editar', array('turma' => $turma->id)) }})
            </div>
        </div>
    @empty
        Você não está em nenhuma turma ):
    @endforelse
@endsection