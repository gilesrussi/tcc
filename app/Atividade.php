<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function getDataAttribute($value) {
        return date('d/m/Y H:i', strtotime($value));
    }


    public function setDataAttribute($value) {
        $date = str_replace('/', '-', $value);
        $this->attributes['data'] = date('Y-m-d H:i', strtotime($date));
    }

    public function getHeaderAttribute($value) {
        $data = Carbon::parse($this->original['data']);
        return $this->tipo_atividade()->get()->first()->nome . " do dia " . $data->format('d/m/Y') . ' às ' . $data->format('H:i');
    }

    public function scopeDoUsuario(Builder $query, User $user, Carbon $de = null, Carbon $ate = null) {
        $query = $de ? $query->where('atividades.data', '>=', $de) : $query;
        $query = $ate ? $query->where('atividades.data', '<', $ate->addDay()) : $query;

        return $query
            ->select(DB::raw('date(atividades.data) as dia'), 'atividades.data', DB::raw('DATE_FORMAT(atividades.data, \'%H:%i\') as `horario_inicio`'), 'atividades.cancelada', 'atividades.turma_id', 'atividades.id', 'atividades.tipo_atividade_id')
            ->join('turmas', 'atividades.turma_id', '=', 'turmas.id')
            ->join('users_turmas', 'turmas.id', '=', 'users_turmas.turma_id')
            ->where('users_turmas.user_id', '=', $user->id)
            ->orderBy('atividades.data');
    }
}
