<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aula extends Model
{
    protected $fillable = ['dia', 'horario_inicio', 'horario_fim'];

    public function turma() {
        return $this->belongsTo('App\Turma');
    }
}
