@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Aulas</h2>
    <ul class="nav list-group">
        @forelse($turma->aulas()->get() as $aula)
            <li class="list-group-item">{{ link_to_action('AulaController@show', $aula->dia . ", das " . $aula->horario_inicio . " às " . $aula->horario_fim, array('turma' => $turma->id, 'aula' => $aula->id)) }}</li>
        @empty
            <li class="list-group-item">Nenhuma aula cadastrada ):</li>
        @endforelse
    </ul>
    {{ link_to_action('AulaController@create', 'Adicionar nova aula!', array('turma' => $turma->id)) }}

@endsection