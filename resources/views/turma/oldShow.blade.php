@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="header col-md-12">
            <h2>Turma de {{ $turma->cid->disciplina->nome }}</h2>
                @can('join', $turma)
                    {{ Form::open(array('url' => "turma/$turma->id/join")) }}
                    {{ Form::submit('Entrar nessa turma') }}
                    {{ Form::close() }}
                @endcan
        </div>
    @cannot('join', $turma)

        @include('turma.sidebar')

        <div class="main col-md-7">
            <div class="row">Instituição: {{ $turma->cid->instituicao->nome }}</div>
            <div class="row">Curso: {{ $turma->cid->curso->nome }}</div>

        </div>
    @endcannot
    </div>
@endsection



@section('footer')

@endsection
