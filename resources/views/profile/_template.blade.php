@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{ Html::image($user->avatar) }}
            {{ $user->name }}
            @yield('headerButtons')
        </div>
        <div class="row profile-friends">
            <div>Amigos:</div>
            <div>
                <ul>
                    @foreach($user->trueFriends()->get() as $friend)
                        <li>{{ $friend->name }}</li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
@endsection