<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $fillable = ['data', 'descricao', 'valor', 'tipo_atividade_id'];

    public function notas() {
        return $this->hasMany('App\Nota');
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

    public function tipo_atividade() {
        return $this->belongsTo('App\TipoAtividade');
    }

    public function turma() {
        return $this->belongsTo('App\Turma');
    }

    public function getHeaderAttribute($value) {
        return $this->tipo_atividade()->get()->first()->nome . " do dia " . $this->data;
    }
}
