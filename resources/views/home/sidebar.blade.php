<div class="col-md-2 sidebar">
    <div class="row">

        <ul class="nav nav-sidebar">
            <li>{{ link_to_action('ProfileController@show', Auth::user()->name, array('user' => Auth::user()->id)) }}</li>
            <li>{{ link_to_action('ProfileController@edit', 'Editar Perfil') }}</li>
        </ul>
        Meus/Minhas
        <ul class="nav nav-sidebar">
            <li>{{ link_to_action('HomeController@notificacoes', 'Notificações') }}</li>
            <li>{{ link_to_action('HomeController@pedidos_amizade', 'Pedidos de amizade') }}</li>
            <li>{{ link_to_action('HomeController@calendario', 'Meu calendário', array('semana' => 0)) }}</li>
        </ul>

        Minhas Turmas
        <ul class="nav nav-sidebar">
            @foreach(Auth::user()->turmas()->get() as $turma)
                <li>{{ link_to_action('TurmaController@show', $turma->cid->disciplina->nome, array('turma' => $turma->id)) }}</li>
            @endforeach
        </ul>
        Resumo
        <ul class="nav nav-sidebar">
            <li>{{ link_to_action('HomeController@anotacoes', 'Minhas anotações')}}</li>
            <li>{{ link_to_action('HomeController@faltas', 'Minhas faltas') }}</li>
            <li>{{ link_to_action('HomeController@notas', 'Minhas notas') }}</li>
        </ul>


    </div>

</div>