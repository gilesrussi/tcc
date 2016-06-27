@extends('home.layout')

@section('inner-content')
    <h2>Pedidos de amizade</h2>
    <ul class="list-group">
        @forelse($pedidos_amizade as $pedido)
            <li class="list-group-item">
                {{ link_to_action('ProfileController@show', $pedido->name, array('user' => $pedido->id)) }}
                {{ Form::open(array('method' => 'POST', 'action' => array('ProfileController@dealWithFriendship', $pedido->id))) }}

                {{ Form::hidden('user_id', $pedido->id) }}
                {{ Form::hidden('aceitar', 1) }}
                {{ Form::submit('Aceitar amigo', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
                {{ Form::open(array('method' => 'POST', 'action' => array('ProfileController@dealWithFriendship', $pedido->id))) }}
                {{ Form::hidden('user_id', $pedido->id) }}
                {{ Form::hidden('aceitar', 0) }}
                {{ Form::submit('Não aceitar amigo', array('class' => 'btn btn-danger')) }}
                {{ Form::close() }}

            </li>

        @empty
            <li class="list-group-item">Você não tem pedidos de amizade para responder ):</li>
        @endforelse
    </ul>
@endsection