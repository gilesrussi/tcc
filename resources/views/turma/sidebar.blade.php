<div class="col-sm-3 col-md-2 sidebar">
    <div class="row">
        @can('join', $turma)
            <ul class="nav nab-sidebar">
                <li>{{ link_to_action('TurmaController@join', "Entrar nessa turma", array("turma" => $turma->id)) }}</li>

            </ul>
        @else
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Resumo <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Aulas</a></li>
                <li><a href="#">Atividades</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="#">Minhas faltas</a></li>
                <li><a href="#">Minhas Anotações</a></li>
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