@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Atividades</h2>
    <ul class="nav list-group">
        @forelse($turma->atividades()->get() as $atividade)
            <li class="list-group-item{{ $atividade->esta_cancelada() ? ' list-group-item-danger' : '' }}">
                {{ link_to_action('AtividadeController@show', $atividade->header, array('turma' => $turma->id, 'atividade' => $atividade->id)) }}
            </li>
        @empty
            <li class="list-group-item">Nenhuma atividade cadastrada ):</li>
        @endforelse
    </ul>
    {{ link_to_action('AtividadeController@create', 'Adicionar nova atividade!', array('turma' => $turma->id)) }}

@endsection