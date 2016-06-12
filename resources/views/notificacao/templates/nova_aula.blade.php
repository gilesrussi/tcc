Uma
{{
link_to_action(
    'AulaController@show',
    'nova aula',
    array(
        'turma' => $model->turma_id,
        'aula' => $model->id
    ))
}}
foi adicionada em sua
{{
link_to_action(
    'TurmaController@show',
    'Turma de ' . $model->turma->cid->disciplina->nome,
    array(
        'turma' => $model->turma_id
    ))
}}
para
{{ $model->header }}