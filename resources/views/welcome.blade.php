@extends('layouts.app')

@section('content')
    <h1>UHUL</h1>
    {!! Form::open() !!}
        {!! Form::text('name') !!}
    {!! Form::close() !!}


@stop