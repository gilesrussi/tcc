<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Anotacao extends Model
{
    /**
     * Variável que diz o nome da tabela no banco de dados :D
     *
     * @var string $table
     */
    protected $table = 'anotacoes';

    protected $fillable = ['anotacao', 'publico'];

    public function associar(Aula $aula, User $user) {
        $this->aula_id = $aula->id;
        $this->user_id = $user->id;
        return $this;
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function aula() {
        return $this->belongsTo('App\Aula');
    }

    public function scopeAnotacaoDoUsuario($query, Aula $aula, User $user) {
        return $query->where('user_id', '=', $user->id)->where('aula_id', '=', $aula->id);
    }

    public function scopeAnotacoesDosOutros($query, Aula $aula, User $user) {
        return $query->where('user_id', '!=', $user->id)->where('aula_id', '=', $aula->id);
    }

    public function scopeDoUsuarioNaTurma(Builder $query, User $user, Turma $turma) {
        return $query
            ->join('aulas', 'aulas.id', '=', 'anotacoes.aula_id')
            ->where('aulas.turma_id', '=', $turma->id)
            ->where('user_id', '=', $user->id);

    }
}
