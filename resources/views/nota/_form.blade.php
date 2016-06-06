
<div class="form-group">
    {{ Form::label('nota', 'Nota: ') }}
    {{ Form::number('nota', null, array('class' => 'form-control')) }}
</div>


<div class="form-group">
    {{ Form::submit($submitButtonText, array('class' => 'form-control btn btn-primary')) }}
</div>


