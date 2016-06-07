@extends('layouts.app')

@section('title')
    - Turmas @yield('title')
@endsection

@section('content')
    <div class="header col-md-12">
        <h2>Turma de {{ $turma->cid->disciplina->nome }}<br><small><small> ({{ $turma->cid->curso->nome }}, {{ $turma->cid->instituicao->nome }})</small></small></h2>
    </div>
    @include('turma.sidebar')

    <div class="col-md-7">
        @yield('inner-content')
    </div>

@endsection