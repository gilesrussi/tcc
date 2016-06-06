<div class="form-group">
    {{ Form::label('nome', 'Nome do arquivo: ') }}
    {{ Form::text('nome', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('link', 'Arquivo: ') }}
    {{ Form::file('link', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('descricao', 'Descrição: ') }}
    {{ Form::textarea('descricao', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::submit($submitButtonText, array('class' => 'form-control btn btn-primary')) }}
</div>


