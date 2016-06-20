@extends('layouts.app')

@section('content')
    <h2>{{ $disciplina->nome }}</h2>
    <div class="panel panel-default">
        <div class="panel-heading">Turmas</div>
        <ul class="list-group">
            @forelse($turmas as $turma)
                <li class="list-group-item">
                    {{ link_to_action('InstituicaoController@show', $turma->cid->instituicao->nome, array('instituicao' => $turma->cid->instituicao_id)) }}
                    - {{ link_to_action('CursoController@show', $turma->cid->curso->nome, array('curso' => $turma->cid->curso_id)) }} -
                    {{ $turma->data_inicio }} - {{ $turma->data_fim }}
                </li>
            @empty
                <li class="list-group-item">Essa disciplina não possui turmas</li>

            @endforelse
        </ul>
    </div>

@endsection
