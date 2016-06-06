<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disciplina extends Model
{
    protected $fillable = ['nome'];

    public function cid() {
        return $this->hasMany('App\CursoInstituicaoDisciplina');
    }
}
