<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{

    protected $fillable = ['nota'];

    public function associar(Atividade $atividade, User $user) {
        $this->atividade_id = $atividade->id;
        $this->user_id = $user->id;
        return $this;
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function atividade() {
        return $this->belongsTo('App\Atividade');
    }

    public function scopeNotaDoUsuario($query, Atividade $atividade, User $user) {
        return $query->where('user_id', '=', $user->id)->where('atividade_id', '=', $atividade->id);
    }

    public function scopeDoUsuarioNaTurma(Builder $query, User $user, Turma $turma) {
        return $query
            ->join('atividades', 'atividades.id', '=', 'notas.atividade_id')
            ->where('atividades.turma_id', '=', $turma->id)
            ->where('user_id', '=', $user->id);

    }
}
