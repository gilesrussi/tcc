@extends('turma.layout')

@section('inner-content')
    <h2>Colegas</h2>
    <ul class="nav list-group">
        @foreach($colegas as $colega)
            <li class="list-group-item">{{ link_to_action('ProfileController@show', $colega->name, $colega->id) }}</li>
        @endforeach
    </ul>
@endsection