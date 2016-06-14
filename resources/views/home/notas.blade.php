@extends('home.layout')

@section('inner-content')
    <h2>Minhas notas</h2>
    @forelse($turmas as $turma)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ link_to_action('TurmaController@show', $turma->cid->disciplina->nome, array('turma' => $turma->id)) }}
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Atividade</th>
                        <th>Valor</th>
                        <th>Minha nota</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($turma->atividades as $atividade)
                        <tr>
                            <td> {{ $atividade->header }}</td>
                            <td> {{ $atividade->valor }}</td>
                            <td> {{ $atividade->notas->count() ? $atividade->notas[0]->nota : 'Sem nota' }}</td>
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
                        </tr>
                    @else
                        <tr><td>Nenhuma atividade para a turma</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    @empty
        Você não está cadastrado em nenhuma turma ):
    @endforelse
@endsection