@extends('turma.layout')

@section('inner-content')
    @include('nota._mostrar', array('notas', $notas))
@endsection
