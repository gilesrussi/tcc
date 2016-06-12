@extends('turma.layout')

@section('inner-content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>Colegas</h4>
        </div>
        <div class="panel-body">
            <ul class="nav list-group">
                @foreach($colegas as $colega)
                    <li class="list-group-item">{{ link_to_action('ProfileController@show', $colega->name, $colega->id) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="panel-footer">
            {{ link_to_action('TurmaController@invite', 'Convide seus amigos para a turma!', array('turma' => $turma->id)) }}
        </div>
    </div>
@endsection