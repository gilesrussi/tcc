A
{{
link_to_action(
    'AulaController@show',
    'aula do dia ' . $original['dia'] . ', das ' . $original['horario_inicio'],
    array(
        'turma' => $model->turma_id,
        'aula' => $model->id
    ))
}}
da turma de
{{
link_to_action(
    'TurmaController@show',
    'Turma de ' . $model->turma->cid->disciplina->nome,
    array(
        'turma' => $model->turma_id
    ))
}}
foi atualizada!