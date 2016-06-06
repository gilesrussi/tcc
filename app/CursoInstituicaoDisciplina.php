<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CursoInstituicaoDisciplina extends Model
{
    protected $fillable = ['instituicao_id', 'curso_id', 'disciplina_id'];

    public function instituicao() {
        return $this->belongsTo(Instituicao::class);
    }

    public function curso() {
        return $this->belongsTo(Curso::class);
    }

    public function disciplina() {
        return $this->belongsTo(Disciplina::class);
    }

    public function turmas() {
        return $this->hasMany('App\Turma', 'instituicao_curso_disciplina_id');
    }
}
