<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $fillable = ['dia', 'horario_inicio', 'horario_fim', 'descricao'];

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
        return "Aula do dia " . $this->dia . ", das " . $this->horario_inicio . " às " . $this->horario_fim;
    }

    public function anotacoes() {
        return $this->hasMany('App\Anotacao');
    }

    public function get(QueryBuilder $query, User $user) {
        return $query->with('')->where('user_id', '=', $user->id)->andWhere('aula_id', '=', $this->id);
    }


}
