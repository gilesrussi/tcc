@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ Html::image($user->avatar, 'alt', array( 'width' => 100, 'height' => 100 )) }}
                {{ $user->name }}
                @yield('headerButtons')
            </div>
        @if($user->isFriend(Auth::user()) || $user->id == Auth::user()->id)
            <div class="panel-body profile-friends">

                <div>Amigos:</div>
                <div>
                    <ul class="list-group">
                        @foreach($user->trueFriends()->get() as $friend)
                            <li class="list-group-item">{{ link_to_action('ProfileController@show', $friend->name, array('user' => $friend->id)) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div>Turmas:</div>
                <div>
                    <ul class="list-group">
                        @foreach($user->turmas()->get() as $turma)
                            <li class="list-group-item">{{ link_to_action('TurmaController@show', $turma->cid->disciplina->nome, array('turma' => $turma->id)) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        </div>
    </div>
@endsection