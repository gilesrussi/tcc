@extends('turma.layout')



@section('inner-content')
    <h2>Minhas notas</h2>
        <div class="panel panel-default">
            <table class="table">
                <thead>
                <tr>
                    <th>Atividade</th>
                    <th>Valor</th>
                    <th>Minha nota</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($turma->atividades as $atividade)
                    <tr>
                        <td> {{ $atividade->header }}</td>
                        <td> {{ $atividade->valor }}</td>
                        <td> {{ $atividade->notas->count() ? $atividade->notas[0]->nota : 'Sem nota' }}</td>
                        <td>
                            <a href="{{ action('AtividadeController@show', array('turma' => $turma->id, 'atividade' => $atividade->id)) }}"><span class="glyphicon glyphicon-eye-open"></span></a>
                            <a href="{{ action('NotaController@edit', array('turma' => $turma->id, 'atividade' => $atividade->id)) }}"><span class="glyphicon glyphicon-pencil"></span></a>
                        </td>
                    </tr>
                @endforeach

                @if($turma->atividades->count() > 0)
                    <tr>
                        <td>Total</td>
                        <td>
                            {{ $turma->atividades->sum('valor') }}
                        </td>
                        <td>
                            {{ $turma
                                ->atividades
                                ->reduce(function ($carry, $atividade)
                                    {
                                        return $atividade->notas->count() ? $carry + $atividade->notas[0]->nota : $carry;
                                    })
                            }}
                        </td>
                        <td></td>
                    </tr>
                @else
                    <tr><td>Nenhuma atividade para a turma</td></tr>
                @endif
                </tbody>
            </table>
        </div>
@endsection