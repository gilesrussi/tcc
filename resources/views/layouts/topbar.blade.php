<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                COED
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                @if (! Auth::guest())
                    <li><a href="{{ url('/') }}">Início</a></li>
                    <li><a href="{{ url('/turma') }}">Turmas</a></li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Entrar</a></li>
                    <li><a href="{{ url('/register') }}">Registre-se</a></li>
                @else
                    <li><a href="{{ action('ProfileController@show', array('user' => Auth::user()->id)) }}">{{ Auth::user()->name }}</a></li>
                    <li><a href="{{ action('HomeController@notificacoes') }}"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span>{{ Auth::user()->notificacoes()->wherePivot('visto', 0)->count() }}</a></li>
                    <li><a href="{{ action('HomeController@pedidos_amizade') }}"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>{{ Auth::user()->friends()->wherePivot('accepted', 0)->count() }}</a></li>
                    <li class="nav navbar-nav">

                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <span class="glyphicon glyphicon-cog"></span> <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/profile/edit') }}"><span class="glyphicon glyphicon-edit"></span> Editar perfil</a></li>
                            <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Sair</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>