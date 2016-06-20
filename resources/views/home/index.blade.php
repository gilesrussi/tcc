@extends('home.layout')

@section('inner-content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Próximas aulas
        </div>
        <ul class="list-group">
            @forelse($aulas as $aula)
                <li class="list-group-item {{ $aula->cancelada ? 'list-group-item-danger' : '' }}">
                    {{ link_to_action('AulaController@show', $aula->turma->cid->disciplina->nome . ' - ' . $aula->header, array('turma' => $aula->turma_id, 'aula' => $aula->id)) }}
                </li>
            @empty
                <li class="list-group-item">Não há mais aulas cadastradas</li>
            @endforelse
        </ul>
        <div class="panel-footer">
            {{ link_to_action('HomeController@calendario', 'Ver mais', array('semana' => 0)) }}
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Próximas atividades
        </div>
        <ul class="list-group">
            @forelse($atividades as $atividade)
                <li class="list-group-item {{ $atividade->cancelada ? 'list-group-item-danger' : '' }}">
                    {{ link_to_action('AtividadeController@show', $atividade->turma->cid->disciplina->nome . ' - ' . $atividade->header, array('turma' => $atividade->turma_id, 'aula' => $atividade->id)) }}
                </li>
            @empty
                <li class="list-group-item">Não há mais atividades cadastradas UHUL!</li>
            @endforelse
        </ul>
        <div class="panel-footer">
            {{ link_to_action('HomeController@calendario', 'Ver mais', array('semana' => 0)) }}
        </div>
    </div>
    {{--
    <div class="panel panel-default">
        <div class="panel-heading">
            Resumo
        </div>

        <table class="table">
            <thead>
            <tr>
                <th class="text-center">
                    {{ link_to_action('TurmaController@index', 'Turma') }}
                </th>
                <th class="text-center">
                    {{ link_to_action('HomeController@notas', 'Nota') }}
                </th>
                <th class="text-center">
                    {{ link_to_action('HomeController@faltas', 'Falta') }}
                </th>
            </tr>
            </thead>

            <tbody>
            @foreach($resumo as $turma)
                <tr>
                    <td>
                        {{ link_to_action('TurmaController@show', $turma->nome, array('turma' => $turma->id)) }}
                    </td>
                    <td>
                        {{ $turma->nota }} / {{ $turma->valor }}
                    </td>
                    <td>
                        {{ $turma->faltas }} / {{ $turma->aulas }}
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>

    </div>
    --}}
    <div class="panel panel-default">
        <div class="panel-heading">
            Últimas anotações compartilhadas
        </div>
        <ul class="list-group">
            @forelse($anotacoes as $anotacao)
                <li class="list-group-item">
                    {{ link_to_action(
                        'AnotacaoController@show',
                        $anotacao->name . ' em ' . $anotacao->aula->turma->cid->disciplina->nome . ' - ' . $aula->header,
                        array(
                            'turma' => $anotacao->aula->turma_id,
                            'aula' => $anotacao->aula_id,
                            'anotacao' => $anotacao->id
                        )
                    ) }}
                </li>
            @empty
                <li class="list-group-item">Item</li>
            @endforelse

        </ul>
    </div>



@endsection
