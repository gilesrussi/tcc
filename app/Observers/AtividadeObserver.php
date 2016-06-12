<?php

namespace App\Observers;
use App\Notificacao;

/**
 * Observes the Users model
 */
class AtividadeObserver
{

    /**
     * Function will be triggerd when a user is updated
     *
     * @param Users $model
     */
    public function created($model)
    {
        $notificacao = new Notificacao();

        $notificacao->mensagem = view('notificacao.templates.nova_atividade', array('model' => $model));

        $notificacao->paraTurma($model->turma()->get()->first());


    }

    public function updated($model) {
        $original = $model->getOriginal();
        $notificacao = new Notificacao();
        if($original['cancelada'] != $model->cancelada) {
            $notificacao->mensagem = view('notificacao.templates.atividade_cancelada', array('model' => $model));

        } else {
            $notificacao->mensagem = view('notificacao.templates.atividade_atualizada', array('model' => $model, 'original' => $original));
        }
        $notificacao->paraTurma($model->turma()->get()->first());

    }
}