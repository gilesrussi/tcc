@extends('home.layout')

@section('inner-content')

    <h2>Minhas turmas</h2>
    <ul class="nav list-group">
    @foreach($minhasTurmas as $turma)
        <li class="list-group-item">{{ link_to_action('TurmaController@show', $turma->cid->disciplina->nome, array('turma' => $turma->id)) }}</li>
    @endforeach
    </ul>
    <a href="turma/find">Entrar em outra turma</a>

@endsection
