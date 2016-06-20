<div class="col-md-2 sidebar">
    <div class="row">

        <ul class="nav nav-sidebar">
            <li>{{ link_to_action('HomeController@index', 'Início') }}</li>
            <li>{{ link_to_action('ProfileController@show', Auth::user()->name, array('user' => Auth::user()->id)) }}</li>
            <li>{{ link_to_action('ProfileController@edit', 'Editar Perfil') }}</li>
        </ul>
        <small>PESSOAL</small>
        <ul class="nav nav-sidebar">
            <li>{{ link_to_action('HomeController@notificacoes', 'Notificações') }}</li>
            <li>{{ link_to_action('HomeController@pedidos_amizade', 'Pedidos de amizade') }}</li>
            <li>{{ link_to_action('HomeController@calendario', 'Meu calendário', array('semana' => 0)) }}</li>
        </ul>

        <small>TURMAS</small>
        <ul class="nav nav-sidebar">
            @foreach(Auth::user()->turmas()->get() as $turma)
                <li>{{ link_to_action('TurmaController@show', $turma->cid->disciplina->nome, array('turma' => $turma->id)) }}</li>
            @endforeach
        </ul>
        <small>RESUMO</small>
        <ul class="nav nav-sidebar">
            <li>{{ link_to_action('HomeController@anotacoes', 'Minhas anotações')}}</li>
            <li>{{ link_to_action('HomeController@faltas', 'Minhas faltas') }}</li>
            <li>{{ link_to_action('HomeController@notas', 'Minhas notas') }}</li>
        </ul>


    </div>

</div>