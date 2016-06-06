@extends('turma.layout')

@section('inner-content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ $atividade->header }} </h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("descricao", "Descrição: ") }}
                <pre>{{ $atividade->descricao }}</pre>
            </div>
            <div class="form-group">
                <h4>Minha Nota:</h4>
                    <div class="form-group">
                    @if(Auth::user()->tenhoNota($atividade))
                    {{ App\Nota::notaDoUsuario($atividade, Auth::user())->get()->first()->nota }} de {{ $atividade->valor }}<br/>
                        {{ link_to_action("NotaController@edit", "Editar minha nota", array('turma' => $turma->id, 'atividade' => $atividade->id)) }}
                    @else

                            Você não possui uma nota para essa atividade.

                        {{ link_to_action("NotaController@create", "Criar minha nota", array('turma' => $turma->id, 'atividade' => $atividade->id)) }}

                    @endif
                    </div>

            </div>
        </div>
        <div class="panel-footer">
            <ul class="list-inline">
                <li>{{link_to_action('AtividadeController@edit', 'Editar atividade', array('turma' => $turma->id, 'atividade' => $atividade->id))}}</li>
                @if($atividade->esta_cancelada())
                <li>{{link_to_action('AtividadeController@descancelar', 'Descancelar atividade', array('turma' => $turma->id, 'atividade' => $atividade->id))}}</li>
                @else
                    <li>{{link_to_action('AtividadeController@cancelar', 'Cancelar atividade', array('turma' => $turma->id, 'atividade' => $atividade->id))}}</li>
                @endif
            </ul>

        </div>
    </div>
@endsection