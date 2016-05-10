@extends('layouts.app')

@section('content')

    <style>
        .checkbox-custom {
            opacity: 0;
        }

        .checkbox-custom, .checkbox-custom-label {
            display: inline-block;
            vertical-align: middle;
            cursor: pointer;
        }

        .checkbox-custom + .checkbox-custom-label:before {
            content: '';
            background: #fff;
            border: 1px solid #ddd;
            display: inline-block;
            vertical-align: middle;
            width: 60px;
            height: 18px;
            text-align: center;
        }

        .checkbox-custom:checked + .checkbox-custom-label:before {
            background: lawngreen;
        }

        .centerText{
            text-align: center;
        }

    </style>

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

        <div class="form-group">
            {{ Form::label('horarios', 'Horários: ') }}
            <table>
                <tr>
                    <th>

                    </th>
                    <th class="centerText">
                        Domingo
                    </th>
                    <th class="centerText">
                        Segunda
                    </th>
                    <th class="centerText">
                        Terça
                    </th>
                    <th class="centerText">
                        Quarta
                    </th>
                    <th class="centerText">
                        Quinta
                    </th>
                    <th class="centerText">
                        Sexta
                    </th>
                    <th class="centerText">
                        Sábado
                    </th>
                </tr>

                {{--*/ $odd = true /*--}}
                @foreach($horarios->groupBy('hora') as $hora => $dias)
                    <tr{{ ($odd) ? " class='odd'" : "" }}>
                        <th class="centerText">
                            {{ $hora }}
                        </th>
                        @foreach($dias->sortBy('dia') as $dia)
                            <td class="centerText">
                            <input id="checkbox-{{ $dia->id }}" class="checkbox-custom" name="checkbox" type="checkbox" value="{{ $dia->id }}">
                            <label for="checkbox-{{ $dia->id }}" class="checkbox-custom-label"></label>
                            </td>
                        @endforeach
                    </tr>
                    {{--*/ $odd =! $odd  /*--}}
                @endforeach

            </table>
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
