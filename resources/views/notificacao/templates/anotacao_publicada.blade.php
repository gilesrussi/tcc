O usuário
{{ link_to_action('ProfileController@show', $model->user->name, array('user' => $model->user_id)) }}
compartilhou
{{ link_to_action('AnotacaoController@show', 'sua anotação', array('turma' => $model->aula->turma_id, 'aula' => $model->aula_id, 'anotacao' => $model->id)) }}
para a
{{ link_to_action('AulaController@show', $model->aula->header, array('turma' => $model->aula->turma_id, 'aula' => $model->aula_id)) }},
em sua turma de
{{ link_to_action('TurmaController@show', $model->aula->turma->cid->disciplina->nome, array('turma' => $model->aula->turma_id)) }}