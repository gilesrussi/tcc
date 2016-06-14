@extends('home.layout')

@section('inner-content')
    <h2>Minhas anotações</h2>
    @forelse($turmas as $turma)
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $turma->cid->disciplina->nome }}
            </div>
            <div class="panel-body">
                Aloka
            </div>
        </div>
    @empty
        Você não está cadastrado em nenhuma turma ):
    @endforelse
@endsection