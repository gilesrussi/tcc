@extends('turma.layout')

@section('inner-content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ $aula->header }} </h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("descricao", "Descrição: ") }}
                <pre>{{ $aula->descricao }}</pre>
            </div>
            <div class="form-group">
                <h4>Anotações:</h4>
                {{ Form::label("minha_anotacao", "Minhas anotações: ") }}
                    <div class="form-group">
                    @if(Auth::user()->tenhoAnotacao($aula))
                        <div class="row">
                            <pre>{{ App\Anotacao::anotacaoDoUsuario($aula, Auth::user())->get()->first()->anotacao }}</pre>
                        </div>
                        {{ link_to_action("AnotacaoController@edit", "Editar minha anotação", array('turma' => $turma->id, 'aula' => $aula->id)) }}
                    @else

                            Você não possui uma anotação para essa aula.

                        {{ link_to_action("AnotacaoController@create", "Criar minha anotação", array('turma' => $turma->id, 'aula' => $aula->id)) }}

                    @endif
                    </div>
                {{ Form::label("anotacoes_colegas", "Anotações dos colegas: ") }}
                <ul class="list-group">
                    @forelse($aula->anotacoes()->where('user_id', '!=', Auth::user()->id)->where('publico', '=', 1)->get() as $anotacao)
                        <li class="list-group-item">{{ link_to_action('AnotacaoController@show', $anotacao->user()->get()->first()->name, array('turma' => $turma->id, 'aula' => $aula->id, 'anotacao' => $anotacao->id)) }}</li>
                    @empty
                        <li class="list-group-item">Nenhum colega seu compartilhou anotações para essa aula ):</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="panel-footer">
            <ul class="list-inline">
                <li>{{link_to_action('AulaController@edit', 'Editar aula', array('turma' => $turma->id, 'aula' => $aula->id))}}</li>
                @if($aula->esta_cancelada())
                <li>{{link_to_action('AulaController@descancelar', 'Descancelar aula', array('turma' => $turma->id, 'aula' => $aula->id))}}</li>
                @else
                    <li>{{link_to_action('AulaController@cancelar', 'Cancelar aula', array('turma' => $turma->id, 'aula' => $aula->id))}}</li>
                @endif
            </ul>

        </div>
    </div>
@endsection