@extends('layouts.app')

@section('content')
<div id="el" class="container">
    {{ Form::open() }}


        <p>Instituicao: @{{instituicao}}</p>
        <p>Curso: @{{curso}}</p>
        <p>Disciplina: @{{disciplina}}</p>

        <div class="form-group">
            {{ Form::label('instituicao', 'Instituição: ') }}
            <select id="instituicao" name="instituicao" v-select="instituicao" class="form-control">
                @foreach($instituicoes as $id => $nome)
                    <option value="{{ $id }}">{{ $nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            {{ Form::label('curso', 'Curso: ') }}
            <select id="curso" name="curso" v-select="curso" :options="options" class="form-control">
                @foreach($cursos as $id => $nome)
                    <option value="{{ $id }}">{{ $nome }}</option>
                @endforeach
            </select>

        </div>

        <div class="form-group">
            {{ Form::label('disciplina', 'Disciplina: ') }}
            <select id="disciplina" name="disciplina" v-select="disciplina" :options="options" class="form-control">
                @foreach($disciplinas as $id => $nome)
                    <option value="{{ $id }}">{{ $nome }}</option>
                @endforeach
            </select>
        </div>


        <turmas></turmas>

    {{ Form::close() }}

    <template id="turmas-template">
        <ul class="list-group">
            <li class="list-group-item" v-for="turma in list">
                @{{ turma.id }} - @{{ turma.instituicao }} - @{{ turma.curso }} - @{{ turma.disciplina }}
            </li>
            <li class="list-group-item"><button class="bnt-primary">Se sua turma não existe, clique aqui para criá-la :D</button></li>
        </ul>
    </template>
</div>
@endsection



@section('footer')
    <script type="text/javascript">






        var vm = new Vue({
            el: '#el',
            data: {
                instituicao: 0,
                curso: 0,
                disciplina: 0,
            },

            components: {
                turmas: {
                    template: '#turmas-template',

                    data: function() {
                        return {
                            list: []
                        };
                    },

                    created: function() {
                        $.getJSON('search', function(turmas) {
                            this.list = turmas;
                        }.bind(this));

                    },

                    methods: {
                        search: function (instituicao, curso, disciplina) {
                            $.getJSON('search', {instituicao: instituicao, curso: curso, disciplina: disciplina}).done(function(data) {this.list = data}.bind(this));
                        }
                    }
                },
            },

            directives: {
                select: {
                    twoWay: true,
                    priority: 1000,

                    params: ['options'],

                    bind: function () {
                        var self = this
                        $(this.el)
                                .select2({
                                    data: this.params.options,
                                    tags: true,
                                    placeholder: "Selecione ou deixe em branco :D",
                                    allowClear: true,
                                })
                                .on('change', function () {
                                    self.set(this.value);
                                    self.vm.updateTurmas();
                                })
                    },
                    update: function (value) {
                        $(this.el).val(value).trigger('change');
                    },
                    unbind: function () {
                        $(this.el).off().select2('destroy')
                    }
                },
            },

            methods: {
                updateTurmas: function() {
                    this.$children[0].search(this.instituicao, this.curso, this.disciplina)
                }
            }
        })
    </script>


@endsection
