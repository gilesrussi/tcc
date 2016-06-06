@extends('turma.layout')

@section('inner-content')
    <h3>{{ $aula->header }}</h3>
    <h4>Anotação de {{ link_to_action('ProfileController@show', $anotacao->user->name, array('user' => $anotacao->user_id)) }}</h4>
    <div class="form-group">
        <pre>{{ $anotacao->anotacao }}</pre>
    </div>
    {{ link_to_action('AulaController@show', 'Voltar', array('turma' => $turma->id, 'aula' => $aula->id)) }}
@endsection