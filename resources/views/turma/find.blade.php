@extends('layouts.app')

@section('content')
<div class="container">
    {{ Form::open() }}
        <div class="form-group">
            {{ Form::label('instituicao', 'Instituição: ') }}
            {{ Form::select('instituicao', collect([null => null])->merge($instituicoes), null, array('class' => 'form-control select2 select2_instituicao')) }}
        </div>

        <div class="form-group">
            {{ Form::label('curso', 'Curso: ') }}
            {{ Form::select('curso', collect([null => null])->merge($cursos), null, array('class' => 'form-control select2 select2_curso')) }}
        </div>
        <div class="form-group">
            {{ Form::label('disciplina', 'Disciplina: ') }}
            {{ Form::select('disciplina', collect([null => null])->merge($disciplinas), null, array('class' => 'form-control select2 select2_curso')) }}
        </div>

    {{ Form::close() }}
</div>
@endsection



@section('footer')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2({
                tags: true,
                placeholder: "Selecione ou deixe em branco :D",
                allowClear: true,
            });
        });
    </script>


@endsection
