<div class="form-group">
    {{ Form::label('tipo_atividade_id', 'Tipo da atividade: ') }}
    {{ Form::select('tipo_atividade_id', $tipo_atividade, null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('data', 'Dia e Hora: ') }}
    {{ Form::datetime('horario_inicio', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('valor', 'Valor: ') }}
    {{ Form::number('valor', null, array('class' => 'form-control')) }}
</div>
<div class="form-group">
    {{ Form::label('descricao', 'Descrição: ') }}
    {{ Form::textarea('descricao', null, array('class' => 'form-control')) }}
</div>

<div class="form-group">
    {{ Form::submit($submitButtonText, array('class' => 'form-control btn btn-primary')) }}
</div>


