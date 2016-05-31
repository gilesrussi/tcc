<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    public $fillable = ['instituicao_curso_disciplina_id'];

    public function cid() {
        return $this->belongsTo('App\CursoInstituicaoDisciplina', 'instituicao_curso_disciplina_id');
    }

    public function scopeWithFilters($query, $instituicao_id = null, $curso_id = null, $disciplina_id = null) {
        $q = $query->join('curso_instituicao_disciplinas', 'turmas.instituicao_curso_disciplina_id', '=', 'curso_instituicao_disciplinas.id')
                   ->join('instituicoes', 'curso_instituicao_disciplinas.instituicao_id', '=', 'instituicoes.id')
                   ->join('cursos', 'curso_instituicao_disciplinas.curso_id', '=', 'cursos.id')
                   ->join('disciplinas', 'curso_instituicao_disciplinas.disciplina_id', '=', 'disciplinas.id');
        $q = $q->select('turmas.id', 'instituicoes.nome as instituicao', 'cursos.nome as curso', 'disciplinas.nome as disciplina');
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

    public function aulas() {
        return $this->hasMany('App\Aula');
    }

    public function adicionarAula() {
        $this->aulas()->attach()
    }

    public function atividades() {
        return $this->hasMany('App\Atividade');
    }
}
