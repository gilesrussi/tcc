<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Ausencia extends Model
{

    public function scopeDoUsuarioNaTurma(Builder $query, User $user, Turma $turma) {
        return $query
            ->join('aulas', 'aulas.id', '=', 'ausencias.aula_id')
            ->where('aulas.turma_id', '=', $turma->id)
            ->where('ausencias.user_id', '=', $user->id);
    }
}
