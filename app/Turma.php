<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Turma extends Model
{
    public $fillable = ['instituicao_curso_disciplina_id', 'data_inicio', 'data_fim', 'carga_horaria'];

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
        return $this->hasMany('App\Aula')->orderBy('dia');
    }

    public function anotacoes() {
        return $this->hasManyThrough('App\Anotacao', 'App\Aula');
    }

    public function materiais() {
        return $this->hasMany('App\Material');
    }

    public function atividades() {
        return $this->hasMany('App\Atividade');
    }

    public function participantes() {
        return $this->belongsToMany('App\User', 'users_turmas');
    }

    public function scopeDaDisciplina($query, Disciplina $disciplina) {
        return $query->whereHas('cid.disciplina', function($query) use($disciplina) {
            return $query->where('id', '=', $disciplina->id);
        });
    }

    public function scopeNotasFaltas(Builder $query, User $user) {
        return $query
            ->select('turmas.id')
            ->join('users_turmas', 'users_turmas.turma_id', '=', 'turmas.id')
            ->where('users_turmas.user_id', '=', $user->id)
            ->with(array('aulas' => function($query) use($user) {
                return $query
                    ->with(array(
                        'ausencias' =>
                            function($query) use($user) {
                                return $query->where('user_id', '=', $user->id);
                            }
                        )
                    );
            }));

    }
}
