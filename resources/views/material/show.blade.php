@extends('turma.layout')

@section('inner-content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ $material->nome }} </h4>
        </div>
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label("descricao", "Descrição: ") }}
                <pre>{{ $material->descricao }}</pre>
            </div>
            <div class="form-group">
                {{ Form::label('link', 'Link: ') }}
                {{ link_to('Materiais/' . $material->link, 'Clique aqui para fazer download!', array('target' => '_blank')) }}

            </div>
        </div>
    </div>
@endsection