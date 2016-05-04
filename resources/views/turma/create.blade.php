@extends('layouts.app')

@section('content')

    <div id="el" class="container">
        {{ Form::model($turma, array('url' => '/turma/create')) }}
        <div class="form-group">
            {{ Form::label('instituicao', 'Instituição: ') }}
            <select id="instituicao" name="instituicao" v-select="instituicao" class="form-control select2">
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
            <select id="curso" name="curso" v-select="curso" class="form-control select2">
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
            <select id="disciplina" name="disciplina" v-select="disciplina" class="form-control select2">
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

        {{ Form::submit('Criar turma', ['class' => 'form-control btn btn-primary']) }}

        {{ Form::close() }}

    </div>
@endsection



@section('footer')
    <script type="text/javascript">
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
