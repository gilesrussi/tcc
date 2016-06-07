<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    protected $table = 'notificacoes';

    protected $fillable = ['mensagem'];

    public function usuarios() {
        return $this->belongsToMany('App\User', 'notificacaos_users')->withPivot('visto')->withTimestamps();
    }

    public function paraTurma(Turma $turma) {
        $this->usuarios()->attach($turma->participantes()->get(['users.id']));
    }
}
