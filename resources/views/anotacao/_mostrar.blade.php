<h3>Minhas anotações</h3>
@forelse($anotacoes as $anotacao)
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ link_to_action('AulaController@show', $anotacao->aula->header, array('turma' => $anotacao->aula->turma_id, 'aula' => $anotacao->aula_id)) }}
        </div>
        <div class="panel-body">
            <pre>{{ $anotacao->anotacao }}</pre>
        </div>
        <div class="panel-footer">
            {{ link_to_action('AnotacaoController@edit', 'Editar', array('turma' => $anotacao->aula->turma_id, 'aula' => $anotacao->aula_id)) }}
        </div>
    </div>
@empty
    Você não possui nenhuma anotação ): Vá em suas turmas e compartilhe!
@endforelse