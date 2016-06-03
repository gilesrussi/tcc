<div class="col-sm-3 col-md-2 sidebar">
    <div class="row">
        @can('join', $turma)
            <ul class="nav nab-sidebar">
                <li>{{ link_to_action('TurmaController@join', "Entrar nessa turma", array("turma" => $turma->id)) }}</li>

            </ul>
        @else
            <ul class="nav nav-sidebar">
                <li>{{ link_to_action('TurmaController@show', 'Mural', array('turma' => $turma->id)) }}</li>
                <li>{{ link_to_action('AulaController@index', 'Aulas', array('turma' => $turma->id)) }}</li>
                <li>{{ link_to_action('AtividadeController@index', 'Atividades', array('turma' => $turma->id)) }}</li>
            </ul>
            <ul class="nav nav-sidebar">
                <li>{{ link_to_action('FaltaController@index', 'Minhas Faltas', array('turma' => $turma->id)) }}</li>
                <li>{{ link_to_action('AnotacaoController@index', 'Minhas Anotações', array('turma' => $turma->id)) }}</li>
                <li><a href="#">Minhas Notas</a></li>

            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="#">Referências</a></li>
                <li><a href="#">Materiais</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li>{{ link_to_action("TurmaController@leave", 'Sair dessa turma', array('turma' => $turma->id)) }}</li>
            </ul>
        @endcan
    </div>

</div>