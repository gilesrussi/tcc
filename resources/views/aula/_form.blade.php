{{ Form::open(array('action' => array('AulaController@store', $turma->id))) }}
    <div class="form-group">
        {{ Form::label('dia', 'Dia: ') }}
        {{ Form::date('dia', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('horario_inicio', 'Horário de início: ') }}
        {{ Form::time('horario_inicio', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('horario_fim', 'Horário de término: ') }}
        {{ Form::time('horario_fim', null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('descricao', 'Descrição: ') }}
        {{ Form::textarea('descricao', null, array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::submit('Adicionar Aula', array('class' => 'form-control btn btn-primary')) }}
    </div>


{{ Form::close() }}