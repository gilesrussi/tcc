@extends('turma.layout')

@section('inner-content')
    @parent
    <h2>Materiais da turma</h2>
    <ul class="nav list-group">
        @forelse($materiais as $material)
            <li class="list-group-item">
                {{ link_to_action('MaterialController@show', $material->nome, array('turma' => $turma->id, 'material' => $material->id)) }}
            </li>
        @empty
            <li class="list-group-item">Nenhum material cadastrado em sua turma ):</li>
        @endforelse
    </ul>
    {{ link_to_action('MaterialController@create', 'Adicionar novo material!', array('turma' => $turma->id)) }}

    <h3>Materiais de outras turmas</h3>
    <ul class="nav list-group">
        @foreach($materiaisOutrasTurmas->cid as $cid)
            @foreach($cid->turmas as $turmas)
                @if($turmas->id != $turma->id)
                    @foreach($turmas->materiais as $materials)
                        <li class="list-group-item">{{ link_to_action('MaterialController@show', $materials->nome, array('turma' => $turmas->id, 'material' => $materials->id)) }}</li>
                    @endforeach
                @endif
            @endforeach
        @endforeach

    </ul>

@endsection