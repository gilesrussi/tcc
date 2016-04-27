<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    public function cid() {
        return $this->belongsTo('App\CursoInstituicaoDisciplina', 'curso_instituicao_disciplina_id');
    }

    public function scopeWithFilters($query, $instituicao_id = null, $curso_id = null, $disciplina_id = null) {
        $q = $query->join('curso_instituicao_disciplinas', 'turmas.instituicao_curso_disciplina_id', '=', 'curso_instituicao_disciplinas.id');
        $q = $q->select('turmas.id');
        if($instituicao_id) {
            $q = $q->where('curso_instituicao_disciplinas.instituicao_id', '=', $instituicao_id);
        }
        if($curso_id) {
            $q = $q->where('curso_instituicao_disciplinas.curso_id', '=', $curso_id);
        }
        if($disciplina_id) {
            $q = $q->where('curso_instituicao_disciplinas.disciplina_id', '=', $disciplina_id);
        }
        return $q;
    }
}
