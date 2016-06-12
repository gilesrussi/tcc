@extends('turma.layout')

@section('inner-content')
    <h2>Convide seus amigos para essa turma</h2>
    <ul class="list-group">
        @forelse($amigos as $amigo)
            <li class="list-group-item">{{ $amigo->name }}<div class="pull-right">{{ link_to_action('TurmaController@inviteFriend', 'Convidar', array('turma' => $turma->id, 'user' => $amigo->id)) }}</div></li>
        @empty
            <li class="list-group-item">Você não tem amigos ):</li>
        @endforelse
    </ul>
@endsection
