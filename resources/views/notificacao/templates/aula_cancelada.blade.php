A
{{
link_to_action(
    'AulaController@show',
    $model->header,
    array(
        'turma' => $model->turma_id,
        'aula' => $model->id
    ))
}}
foi
{{ $model->esta_cancelada() ? 'cancelada' : 'descancelada' }}
em sua turma de
{{
link_to_action(
    'TurmaController@show',
    'Turma de ' . $model->turma->cid->disciplina->nome,
    array(
        'turma' => $model->turma_id
    ))
}}