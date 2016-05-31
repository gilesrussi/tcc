@extends('turma.layout')

@section('inner-content')
    @parent
        <div class="main col-md-7">
            <div class="row">Instituição: {{ $turma->cid->instituicao->nome }}</div>
            <div class="row">Curso: {{ $turma->cid->curso->nome }}</div>
            @can('post', $turma)
                Aqui vai estar o resumo das coisas da turma, como próximas aulas, atividades, notas, faltas, etc.
            @endcan
        </div>
@endsection
