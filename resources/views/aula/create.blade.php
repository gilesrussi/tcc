@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Criar aula</h2>
    @include('aula._form')

@endsection