@extends('layouts.app')

@section('content')
<div id="el" class="container">
    {{ Form::open(array('url' => '/turma/create')) }}

        <div class="form-group">
            {{ Form::label('instituicao', 'Instituição: ') }}
            <select id="instituicao" name="instituicao" v-select="instituicao" class="form-control" data-init-text="bla bla">
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
        <ul class="nav list-group">
            <li class="list-group-item" v-for="turma in list">
                <a href="{{ url('turma') }}/@{{ turma.id }}">@{{ turma.id }} - @{{ turma.instituicao }} - @{{ turma.curso }} - @{{ turma.disciplina }}</a>
            </li>
            <li class="list-group-item">{{ Form::submit('Sua turma não existe ainda? Clique aqui para criá-la!', ['class' => 'btn-primary']) }}</li>
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

                    methods: {
                        search: function (instituicao, curso, disciplina) {
                            $.getJSON('search', {instituicao: instituicao, curso: curso, disciplina: disciplina}).done(function(data) {this.list = data.data}.bind(this));
                            console.log(this);
                        },




                    }
                }
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
