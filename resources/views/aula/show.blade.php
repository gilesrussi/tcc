@extends('turma.layout')

@section('inner-content')
    {{ $aula->dia }}
    <br>
    {{ $aula->horario_inicio }}
    {{ $aula->horario_fim }}
@endsection