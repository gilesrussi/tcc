@extends('home.layout')

@section('inner-content')
    <div class="list-inline">
    <nav class="inline">
        <ul class="pager">
            <li class="previous"><a href="{{ action('HomeController@calendario', array('semana' => $semana-1)) }}"><span class="glyphicon glyphicon-menu-left"></span>Anterior</a></li>
            <li><b class="fa-2x">Meu calendário</b></li>
            <li class="next"><a href="{{ action('HomeController@calendario', array('semana' => $semana+1)) }}">Próxima<span class="glyphicon glyphicon-menu-right"></span></a></li>
        </ul>
    </nav>
    </div>
    <div class="panel panel-default">
        <div class="panel-body table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th></th>
                        <th class="text-center">
                            Domingo<br>({{ $de->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Segunda<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Terça<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Quarta<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Quinta<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Sexta<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                        <th class="text-center">
                            Sábado<br>({{ $de->addDay()->format('d/m') }})
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>A<br>U<br>L<br>A<br>S</th>
                        <td>
                            @if($aulas->get($de->subDays(6)->format('d/m/Y')))
                                @foreach($aulas->get($de->format('d/m/Y')) as $aula)
                                    <div class="item-calendario {{ $aula->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $aula->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $aula->turma->cid->disciplina->nome, array('turma' => $aula->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AulaController@show', $aula->horario_inicio . '-' . $aula->horario_fim, array('turma' => $aula->turma_id, 'aula' => $aula->id)) }}
                                        {!!  $aula->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($aulas->get($de->addDay()->format('d/m/Y')))
                                @foreach($aulas->get($de->format('d/m/Y')) as $aula)
                                    <div class="item-calendario {{ $aula->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $aula->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $aula->turma->cid->disciplina->nome, array('turma' => $aula->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AulaController@show', $aula->horario_inicio . '-' . $aula->horario_fim, array('turma' => $aula->turma_id, 'aula' => $aula->id)) }}
                                        {!!  $aula->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($aulas->get($de->addDay()->format('d/m/Y')))
                                @foreach($aulas->get($de->format('d/m/Y')) as $aula)
                                    <div class="item-calendario {{ $aula->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $aula->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $aula->turma->cid->disciplina->nome, array('turma' => $aula->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AulaController@show', $aula->horario_inicio . '-' . $aula->horario_fim, array('turma' => $aula->turma_id, 'aula' => $aula->id)) }}
                                        {!!  $aula->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($aulas->get($de->addDay()->format('d/m/Y')))
                                @foreach($aulas->get($de->format('d/m/Y')) as $aula)
                                    <div class="item-calendario {{ $aula->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $aula->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $aula->turma->cid->disciplina->nome, array('turma' => $aula->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AulaController@show', $aula->horario_inicio . '-' . $aula->horario_fim, array('turma' => $aula->turma_id, 'aula' => $aula->id)) }}
                                        {!!  $aula->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($aulas->get($de->addDay()->format('d/m/Y')))
                                @foreach($aulas->get($de->format('d/m/Y')) as $aula)
                                    <div class="item-calendario {{ $aula->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $aula->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $aula->turma->cid->disciplina->nome, array('turma' => $aula->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AulaController@show', $aula->horario_inicio . '-' . $aula->horario_fim, array('turma' => $aula->turma_id, 'aula' => $aula->id)) }}
                                        {!!  $aula->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($aulas->get($de->addDay()->format('d/m/Y')))
                                @foreach($aulas->get($de->format('d/m/Y')) as $aula)
                                    <div class="item-calendario {{ $aula->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $aula->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $aula->turma->cid->disciplina->nome, array('turma' => $aula->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AulaController@show', $aula->horario_inicio . '-' . $aula->horario_fim, array('turma' => $aula->turma_id, 'aula' => $aula->id)) }}
                                        {!!  $aula->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($aulas->get($de->addDay()->format('d/m/Y')))
                                @foreach($aulas->get($de->format('d/m/Y')) as $aula)
                                    <div class="item-calendario {{ $aula->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $aula->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $aula->turma->cid->disciplina->nome, array('turma' => $aula->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AulaController@show', $aula->horario_inicio . '-' . $aula->horario_fim, array('turma' => $aula->turma_id, 'aula' => $aula->id)) }}
                                        {!!  $aula->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>

                    </tr>
                    <tr>
                        <th>A<br>T<br>I<br>V<br>I<br>D<br>A<br>D<br>E<br>S</th>
                        <td>
                            @if($atividades->get($de->subDays(6)->format('Y-m-d')))
                                @foreach($atividades->get($de->format('Y-m-d')) as $atividade)
                                    <div class="item-calendario {{ $atividade->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $atividade->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $atividade->tipo_atividade->nome . ' de ' . $atividade->turma->cid->disciplina->nome, array('turma' => $atividade->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AtividadeController@show', $atividade->horario_inicio, array('turma' => $atividade->turma_id, 'atividade' => $atividade->id)) }}
                                        {!!  $atividade->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($atividades->get($de->addDay()->format('Y-m-d')))
                                @foreach($atividades->get($de->format('Y-m-d')) as $atividade)
                                    <div class="item-calendario {{ $atividade->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $atividade->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $atividade->tipo_atividade->nome . ' de ' . $atividade->turma->cid->disciplina->nome, array('turma' => $atividade->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AtividadeController@show', $atividade->horario_inicio, array('turma' => $atividade->turma_id, 'atividade' => $atividade->id)) }}
                                        {!!  $atividade->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($atividades->get($de->addDay()->format('Y-m-d')))
                                @foreach($atividades->get($de->format('Y-m-d')) as $atividade)
                                    <div class="item-calendario {{ $atividade->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $atividade->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $atividade->tipo_atividade->nome . ' de ' . $atividade->turma->cid->disciplina->nome, array('turma' => $atividade->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AtividadeController@show', $atividade->horario_inicio, array('turma' => $atividade->turma_id, 'atividade' => $atividade->id)) }}
                                        {!!  $atividade->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($atividades->get($de->addDay()->format('Y-m-d')))
                                @foreach($atividades->get($de->format('Y-m-d')) as $atividade)
                                    <div class="item-calendario {{ $atividade->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $atividade->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $atividade->tipo_atividade->nome . ' de ' . $atividade->turma->cid->disciplina->nome, array('turma' => $atividade->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AtividadeController@show', $atividade->horario_inicio, array('turma' => $atividade->turma_id, 'atividade' => $atividade->id)) }}
                                        {!!  $atividade->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($atividades->get($de->addDay()->format('Y-m-d')))
                                @foreach($atividades->get($de->format('Y-m-d')) as $atividade)
                                    <div class="item-calendario {{ $atividade->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $atividade->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $atividade->tipo_atividade->nome . ' de ' . $atividade->turma->cid->disciplina->nome, array('turma' => $atividade->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AtividadeController@show', $atividade->horario_inicio, array('turma' => $atividade->turma_id, 'atividade' => $atividade->id)) }}
                                        {!!  $atividade->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($atividades->get($de->addDay()->format('Y-m-d')))
                                @foreach($atividades->get($de->format('Y-m-d')) as $atividade)
                                    <div class="item-calendario {{ $atividade->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $atividade->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $atividade->tipo_atividade->nome . ' de ' . $atividade->turma->cid->disciplina->nome, array('turma' => $atividade->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AtividadeController@show', $atividade->horario_inicio, array('turma' => $atividade->turma_id, 'atividade' => $atividade->id)) }}
                                        {!!  $atividade->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if($atividades->get($de->addDay()->format('Y-m-d')))
                                @foreach($atividades->get($de->format('Y-m-d')) as $atividade)
                                    <div class="item-calendario {{ $atividade->cancelada ? 'bg-danger' : 'bg-success' }} text-center">
                                        {!!  $atividade->cancelada ? "<del>" : "" !!}
                                        <strong>
                                            {{ link_to_action('TurmaController@show', $atividade->tipo_atividade->nome . ' de ' . $atividade->turma->cid->disciplina->nome, array('turma' => $atividade->turma_id)) }}
                                        </strong>
                                        <br>
                                        {{ link_to_action('AtividadeController@show', $atividade->horario_inicio, array('turma' => $atividade->turma_id, 'atividade' => $atividade->id)) }}
                                        {!!  $atividade->cancelada ? "</del>" : "" !!}
                                    </div>
                                @endforeach
                            @endif
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection