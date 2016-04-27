<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoInstituicaoDisciplina extends Model
{
    protected $fillable = ['instituicao_id', 'curso_id', 'disciplina_id'];
}
