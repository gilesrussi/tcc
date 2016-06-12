<?php

namespace App\Observers;
use App\Anotacao;
use App\Notificacao;

/**
 * Observes the Users model
 */
class AnotacaoObserver
{

    /**
     * Function will be triggerd when a user is updated
     *
     * @param Users $model
     */
    public function created($model)
    {
        $notificacao = new Notificacao();
        if($model->publico == 1) {
            $notificacao->mensagem = view('notificacao.templates.nova_anotacao', array('model' => $model));

            $notificacao->paraTurma($model->turma()->get()->first());
        }

    }

    public function updated($model) {
        $original = $model->getOriginal();
        $notificacao = new Notificacao();
        if($model->publico == 1) {
            if($original['publico'] != $model->publico) {
                $notificacao->mensagem = view('notificacao.templates.anotacao_publicada', array('model' => $model));

            } else {
                $notificacao->mensagem = view('notificacao.templates.anotacao_atualizada', array('model' => $model, 'original' => $original));
            }
            $notificacao->paraTurma($model->turma()->get()->first());
        }


    }
}