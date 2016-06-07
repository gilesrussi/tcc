@extends('turma.layout')

@section('inner-content')
    @parent
        <div class="main col-md-10">

            @can('post', $turma)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Próximas aulas
                    </div>
                    <ul class="list-group">
                        @forelse($aulas as $aula)
                            <li class="list-group-item">{{ link_to_action('AulaController@show', $aula->header, array('turma' => $turma, 'aula' => $aula->id)) }}</li>
                        @empty
                            <li class="list-group-item">Não tem mais aulas :D</li>
                        @endforelse
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Próximas atividades
                    </div>
                    <ul class="list-group">
                        @forelse($atividades as $atividade)
                            <li class="list-group-item">{{ link_to_action('AtividadeController@show', $atividade->header, array('turma' => $turma, 'atividade' => $atividade->id)) }}</li>
                        @empty
                            <li class="list-group-item">Não há nenhuma atividade marcada :D</li>
                        @endforelse
                    </ul>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Últimas anotações atualizadas
                    </div>
                    <ul class="list-group">
                        @forelse($anotacoes as $anotacao)
                            <li class="list-group-item">
                                {{ link_to_action('AnotacaoController@show',
                                    $anotacao->user->name . ' @ ' . $anotacao->aula->header,
                                    array(
                                        'turma' => $turma,
                                        'aula' => $anotacao->aula_id,
                                        'anotacao' => $anotacao->id
                                 )) }}
                            </li>
                        @empty
                            <li class="list-group-item">Não há nenhuma atividade marcada :D</li>
                        @endforelse
                    </ul>
                </div>

            @endcan
        </div>
@endsection
