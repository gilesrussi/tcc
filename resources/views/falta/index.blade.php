@extends('turma.layout')

@section('inner-content')

    <h2>Minhas faltas<small>(Total: {{ $faltas->count() }})</small></h2>
    {{ Form::open(array('action' => array('FaltaController@store', $turma->id))) }}
    <ul class="list-group">
    @forelse($aulas as $aula)
        <li class="list-group-item {{ $faltas->where('aula_id', $aula->id)->count()? 'list-group-item-danger': 'list-group-item-success' }}">
            {{ Form::checkbox(
                'falta[]',
                $aula->id,
                $faltas->where('aula_id', $aula->id)->count(),
                 array('id' => 'falta-' . $aula->id)) }}
            {{ Form::label('falta-' . $aula->id, $aula->header . ($aula->esta_cancelada() ? ' (Cancelada)' : '')) }}
        </li>
    @empty
        <li class="list-group-item">Não há nenhuma aula cadastrada</li>
    @endforelse
    </ul>
    {{ Form::submit('Salvar', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}



@endsection