@extends('layouts.app')

@section('content')

    <div id="el" class="container">
        {{ Form::model($turma, array('action' => 'TurmaController@store')) }}
        <div class="form-group">
            {{ Form::label('instituicao', 'Instituição: ') }}
            <select id="instituicao" name="instituicao" v-select="instituicao" class="form-control select2" required>
                <option></option>
                @foreach($instituicoes as $id => $nome)
                    @if($turma->instituicao == $id)
                        <option value="{{ $id }}" selected>{{ $nome }}</option>
                    @else
                        <option value="{{ $id }}">{{ $nome }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('curso', 'Curso: ', ['class' => 'control-label']) }}
            <select id="curso" name="curso" v-select="curso" class="form-control select2" required>
                @foreach($cursos as $id => $nome)
                    <option></option>
                    @if($turma->curso == $id)
                        <option value="{{ $id }}" selected>{{ $nome }}</option>
                    @else
                        <option value="{{ $id }}">{{ $nome }}</option>
                    @endif
                @endforeach
            </select>

        </div>

        <div class="form-group">
            {{ Form::label('disciplina', 'Disciplina: ') }}
            <select id="disciplina" name="disciplina" v-select="disciplina" class="form-control select2" required>
                @foreach($disciplinas as $id => $nome)
                    <option></option>
                    @if($turma->disciplina == $id)
                        <option value="{{ $id }}" selected>{{ $nome }}</option>
                    @else
                        <option value="{{ $id }}">{{ $nome }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('data_inicio', 'Data de início: ', array('required' => 'required')) }}
            <div>
                {{ Form::date('data_inicio', null, array('class'=>'form-control')) }}
            </div>
        </div>

        <div>
            {{ Form::label('mensagem', 'Para criar aulas automaticamente, preencha os campos abaixo') }}
        </div>

        <div class="form-group">
            {{ Form::label('data_fim', 'Data de conclusão: ') }}

            {{ Form::date('data_fim', null, array('class'=>'form-control')) }}

        </div>

        <div class="form-group">
            {{ Form::label('carga_horaria', 'Carga horária da disciplina: ') }}
            {{ Form::number('carga_horaria', null, array('class'=>'form-control')) }}
        </div>

        <div class="horarios_aula">
            <div class="form-group">
                <div class="col-md-4">
                    {{ Form::label('dia[]', 'Dia da aula: ') }}
                    {{ Form::select('dia[]', $dias_semana, null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('horario_inicio[]', 'Horário de início da aula: ') }}
                    {{ Form::time('horario_inicio[]', null, array('class' => 'form-control')) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('horario_fim[]', 'Horário de término da aula: ') }}
                    {{ Form::time('horario_fim[]', null, array('class' => 'form-control')) }}
                </div>
            </div>
        </div>
        <div class="form-group">
            {{ Form::button('Adicionar mais uma aula por semana', array('class' => 'form-control btn btn-info'))  }}
        </div>

        <div class="form-group">
            {{ Form::submit('Criar turma', ['class' => 'form-control btn btn-primary']) }}
        </div>
        {{ Form::close() }}



    </div>
@endsection



@section('footer')
    <script type="text/javascript">
        $(document).ready(function() {
            var max_fields      = 10; //maximum input boxes allowed
            var wrapper         = $(".horarios_aula"); //Fields wrapper
            var add_button      = $(".btn-info"); //Add button ID

            var x = 1; //initlal text box count
            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                if(x < max_fields){ //max input box allowed
                    x++; //text box increment
                    $(wrapper).append('<div class="form-group"><div class="col-md-4">{{ Form::label('dia[]', 'Dia da aula: ') }}{{ Form::select('dia[]', $dias_semana, null, array('class' => 'form-control')) }}</div> <div class="col-md-4">{{ Form::label('horario_inicio[]', 'Horário de início da aula: ') }}{{ Form::time('horario_inicio[]', null, array('class' => 'form-control')) }}</div> <div class="col-md-4">{{ Form::label('horario_fim[]', 'Horário de término da aula: ') }}{{ Form::time('horario_fim[]', null, array('class' => 'form-control')) }}</div> </div>'); //add input box
                }
            });
        });


        var vm = new Vue({
            el: '#el',
            directives: {
                select: {
                    priority: 1000,

                    bind: function () {
                        var self = this
                        $(this.el)
                                .select2({
                                    placeholder: "Selecione ou escreva o nome! :D",
                                    tags: true
                                })
                    },
                    unbind: function () {
                        $(this.el).off().select2('destroy')
                    }
                },
            },
        })
    </script>


@endsection
