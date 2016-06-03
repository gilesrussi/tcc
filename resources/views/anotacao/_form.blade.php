
<div class="form-group">
    {{ Form::label('anotacao', 'Descrição: ') }}
    {{ Form::textarea('anotacao', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::label('publico', 'Deixar público: ') }}
    {{ Form::radio('publico', 1, array('class' => 'form-control')) }}
    {{ Form::label('publico', 'Sim') }}
    {{ Form::radio('publico', 0, array('class' => 'form-control')) }}
    {{ Form::label('publico', 'Não') }}

</div>

<div class="form-group">
    {{ Form::submit($submitButtonText, array('class' => 'form-control btn btn-primary')) }}
</div>


