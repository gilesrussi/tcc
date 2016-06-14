@extends('home.layout')

@section('inner-content')
    <h2>Minhas anotações</h2>
    @forelse($turmas as $turma)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ link_to_action('TurmaController@show', $turma->cid->disciplina->nome, array('turma' => $turma->id)) }}
            </div>
            <ul class="list-group">
                @forelse($turma->aulas->filter(function ($aula) { return (bool)$aula->anotacoes->count();}) as $aula)
                    <li class="list-group-item">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                {{ link_to_action('AulaController@show', $aula->header, array('turma' => $turma->id, 'aula' => $aula->id)) }}
                            </div>
                            <div class="panel-body">
                                <pre>{{ $aula->anotacoes[0]->anotacao }}</pre>
                            </div>
                        </div>

                    </li>
                @empty
                    <li class="list-group-item">
                        Você não tem anotações para essa turma ):
                    </li>
                @endforelse
            </ul>
        </div>
    @empty
        Você não está cadastrado em nenhuma turma ):
    @endforelse
@endsection