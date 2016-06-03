@extends('turma.layout')

@section('inner-content')
    @include('anotacao._mostrar', array('anotacoes', $anotacoes))
@endsection
