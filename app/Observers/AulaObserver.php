<?php

namespace App\Observers;
use App\Notificacao;

/**
 * Observes the Users model
 */
class AulaObserver
{
    /**
     * Function will be triggerd when a user is updated
     *
     * @param Users $model
     */
    public function saved($model)
    {
        $notificacao = new Notificacao();

        $notificacao->mensagem = 'Uma ' . link_to_action('AulaController@show', 'nova aula', array('turma' => $model->turma_id, 'aula' => $model->id)) . ' foi adicionada em sua ' . link_to_action('TurmaController@show', 'Turma de ' . $model->turma->cid->disciplina->nome, array('turma' => $model->turma_id)) . ' para ' . $model->header;

        $notificacao->save();

        $notificacao->paraTurma($model->turma()->get()->first());
    }
}