Você foi convidado para participar da
{{ link_to_action('TurmaController@show', 'Turma de' . $turma->cid->disciplina->nome, array('turma' => $turma->id)) }}
por seu amigo
{{ link_to_action('ProfileController@show', $sender->name, array('user' => $sender->id)) }}