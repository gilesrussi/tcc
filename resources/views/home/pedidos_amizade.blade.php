@extends('home.layout')

@section('inner-content')
    <h2>Pedidos de amizade</h2>
    <ul class="list-group">
        @forelse($pedidos_amizade as $pedido)
            <li class="list-group-item">{{ link_to_action('ProfileController@show', $pedido->name, array('user' => $pedido->id)) }}</li>
        @empty
            <li class="list-group-item">Você não tem pedidos de amizade para responder ):</li>
        @endforelse
    </ul>
@endsection