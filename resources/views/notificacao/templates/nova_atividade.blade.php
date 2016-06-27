Uma
{{
link_to_action(
    'AtividadeController@show',
    'nova atividade',
    array(
        'turma' => $model->turma_id,
        'atividade' => $model->id
    ))
}}
foi adicionada em sua
{{
link_to_action(
    'TurmaController@show',
    'Turma de ' . $model->turma->cid->disciplina->nome,
    array(
        'turma' => $model->turma_id
    ))óó
}}
, sendo essa uma
{{ $model->tipo_atividade()->get()->first()->nome . ", " . $model->data}}