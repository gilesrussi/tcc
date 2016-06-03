@extends('turma.layout')

@section('inner-content')
    <h3>{{ $aula->header }} <small>{{link_to_action('AulaController@edit', '(Editar aula)', array('turma' => $turma->id, 'aula' => $aula->id))}}</small></h3>
    <div class="form-group">
        {{ Form::label("descricao", "Descrição: ") }}
        {{ $aula->descricao }}
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
                <div class="row">
                    Você não possui uma anotação para essa aula.
                </div>
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
@endsection