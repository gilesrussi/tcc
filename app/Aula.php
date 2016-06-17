<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $fillable = ['dia', 'horario_inicio', 'horario_fim', 'descricao', 'turma_id'];

    protected $dates = ['created_at', 'updated_at', 'dia'];

    

    public function getDiaAttribute($value) {
        return date('d/m/Y', strtotime($value));
    }

    public function getHorarioInicioAttribute($value) {
        return date('H:i', strtotime($value));
    }

    public function getHorarioFimAttribute($value) {
        return date('H:i', strtotime($value));
    }

    public function setDiaAttribute($value) {
        $date = str_replace('/', '-', $value);
        $this->attributes['dia'] = date('Y-m-d', strtotime($date));
    }

    public function turma() {
        return $this->belongsTo('App\Turma');
    }

    public function getHeaderAttribute($value) {
        $header = "Aula do dia " . $this->dia . ", das " . $this->horario_inicio . " às " . $this->horario_fim;
        $header .= $this->esta_cancelada() ? " (Cancelada)" : "";
        return $header;
    }

    public function anotacoes() {
        return $this->hasMany('App\Anotacao');
    }

    public function ausencias() {
        return $this->hasMany('App\Ausencia');
    }

    public function cancelar() {
        $this->cancelada = 1;
        $this->save();
    }

    public function descancelar() {
        $this->cancelada = 0;
        $this->save();
    }
    
    public function esta_cancelada() {
        return (bool) $this->cancelada;
    }

    public function scopeDoUsuario(Builder $query, User $user, Carbon $de = null, Carbon $ate = null) {
        $query = $de ? $query->where('aulas.dia', '>=', $de) : $query;
        $query = $ate ? $query->where('aulas.dia', '<=', $ate) : $query;

        return $query
            ->select('aulas.id', 'aulas.dia', 'aulas.horario_inicio', 'aulas.horario_fim', 'aulas.cancelada', 'aulas.turma_id')
            ->join('turmas', 'aulas.turma_id', '=', 'turmas.id')
            ->join('users_turmas', 'turmas.id', '=', 'users_turmas.turma_id')
            ->where('users_turmas.user_id', '=', $user->id)
            ->orderBy('aulas.dia', 'desc');
    }


}
