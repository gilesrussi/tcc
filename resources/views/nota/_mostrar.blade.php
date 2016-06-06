<h3>Minhas notas</h3>
@forelse($notas as $nota)
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ link_to_action('AtividadeController@show', $nota->atividade->header, array('turma' => $nota->atividade->turma_id, 'atividade' => $nota->atividade_id)) }}
        </div>
        <div class="panel-body">
            {{ $nota->nota }} de {{$nota->atividade->valor}}
        </div>
        <div class="panel-footer">
            {{ link_to_action('NotaController@edit', 'Editar', array('turma' => $nota->atividade->turma_id, 'atividade' => $nota->atividade_id)) }}
        </div>
    </div>
@empty
    Você não possui nenhuma nota ): Vá em suas turmas e compartilhe!
@endforelse