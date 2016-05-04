@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header col-md-12">
            <h2>Turma {{ $turma->id }}</h2>
                @can('join', $turma)
                    {{ Form::open(array('url' => "turma/$turma->id/join")) }}
                    {{ Form::submit('Entrar nessa turma') }}
                    {{ Form::close() }}
                @endcan
        </div>
    @cannot('join', $turma)
        <div class="col-sm-3 col-md-2 sidebar">
            <div class="row">
                <ul class="nav nav-sidebar">
                    <li class="active"><a href="#">Resumo <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Aulas</a></li>
                    <li><a href="#">Atividades</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li><a href="#">Minhas faltas</a></li>
                    <li><a href="#">Minhas Anotações</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li><a href="#">Referências</a></li>
                    <li><a href="#">Materiais</a></li>
                </ul>
                <ul class="nav nav-sidebar">
                    <li><a href="leave">Sair dessa Turma</a></li>
                </ul>
            </div>

        </div>
        <div class="body col-md-7">
            {{ var_dump($turma) }}

        </div>
    @endcannot
    </div>
@endsection



@section('footer')

@endsection
