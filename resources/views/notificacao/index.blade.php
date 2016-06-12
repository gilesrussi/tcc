@extends('layouts.app')

@section('content')
    <h2>Notificações</h2>
    <ul class="list-group">
        @foreach($notificacoes as $notificacao)
            <li class="list-group-item{{ $notificacao->foiVisto() ? " novo" : ""}}">{!! $notificacao->mensagem !!}</li>
        @endforeach
    </ul>
@endsection