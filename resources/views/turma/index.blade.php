@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Minhas turmas</h2>
    @foreach($minhasTurmas as $turma)
        {{ $turma->id }}
    @endforeach
    <a href="turma/find">Entrar em outra turma</a>
</div>
@endsection



@section('footer')

@endsection
