@extends('layouts.app')

@section('title')
    - Turmas @yield('title')
@endsection

@section('content')
    <div class="header col-md-12">
        <h2>Turma de {{ link_to_action('DisciplinaController@show', $turma->cid->disciplina->nome, $turma->cid->disciplina->id) }}<br><small><small> ({{ link_to_action('CursoController@show', $turma->cid->curso->nome, $turma->cid->curso_id) }}, {{ link_to_action('InstituicaoController@show', $turma->cid->instituicao->nome, $turma->cid->instituicao_id) }})</small></small></h2>
    </div>
    @include('turma.sidebar')

    <div class="col-md-7">
        @yield('inner-content')
    </div>

@endsection