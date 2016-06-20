<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function join(Turma $turma) {
        $this->turmas()->attach($turma->id);
    }

    public function leave(Turma $turma) {
        $this->turmas()->detach($turma->id);
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function turmas() {
        return $this->belongsToMany('App\Turma', 'users_turmas')->withTimestamps();
    }

    public function participates(Turma $turma) {
        return (bool) $this->turmas()->where('turma_id','=',$turma->id)->count();
    }

    public function tenhoAnotacao(Aula $aula) {
        return (bool) $this->anotacoes()->where('aula_id', '=', $aula->id)->count();
    }

    public function tenhoNota(Atividade $atividade) {
        return (bool) $this->notas()->where('atividade_id', '=', $atividade->id)->count();
    }

    public function anotacoes() {
        return $this->hasMany('App\Anotacao');
    }

    public function notas() {
        return $this->hasMany('App\Nota');
    }

    public function faltas() {
        return $this->hasMany('App\Ausencia');
    }

    public function notificacoes() {
        return $this->belongsToMany('App\Notificacao', 'notificacaos_users')->withPivot('visto')->withTimestamps()->orderBy('notificacaos_users.id', 'desc');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friends()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_of')->withPivot('accepted')->withTimestamps();
    }

    /**
     * @param $query
     * @param int $search
     */
    public function scopeTrueFriends($query, $search = 1) {
        $pivot = $this->friends()->getTable();

        $query->whereHas('friends', function ($q) use ($search, $pivot) {
            $q->where("{$pivot}.accepted", $search)
              ->where("{$pivot}.friend_of", $this->id);
        });

    }

    public function scopeFriendRequestsRecieved($query, $accepted = 0) {
        $pivot = $this->friends()->getTable();

        $query->whereHas('friends', function ($q) use ($accepted, $pivot) {
            $q->where("{$pivot}.accepted", $accepted)
                ->where("{$pivot}.friend_of", $this->id);
        });

    }


    /**
     * @param User $user
     * @return bool
     */
    public function isFriend(User $user) {
        return (bool) $this->friends()->where("friend_of", $user->id)->wherePivot("accepted", 1)->count();

    }

    /**
     * @param User $user
     * @return bool
     */
    public function canRespondTo(User $user) {
        return (bool) $this->friends()->where("friend_of", $user->id)->wherePivot('accepted', 0)->count();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isWaitingForResponseFrom(User $user) {
        return (bool) $user->friends()->where("friend_of", $this->id)->wherePivot('accepted', 0)->count();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function noEntry(User $user) {
        return !((bool) $this->friends()->where("friend_of", $user->id)->count() + 
                        $user->friends()->where("friend_of", $this->id)->count());
    }

    /**
     * @param User $user
     */
    public function sendFriendshipRequest(User $user) {
        $user->friends()->attach($this->id, array('accepted' => 0));
    }

    /**
     * @param User $user
     */
    public function cancelFriendshipRequest(User $user) {
        $user->friends()->detach($this->id);
    }

    /**
     * @param User $user
     */
    public function acceptFriendshipRequest(User $user) {
        $user->friends()->attach($this->id, array('accepted' => 1));
        $this->friends()->updateExistingPivot($user->id, array('accepted' => 1));
    }

    /**
     * @param User $user
     */
    public function rejectFriendshipRequest(User $user) {
        $this->friends()->detach($user->id);
    }

    /**
     * @param User $user
     */
    public function breakFriendship(User $user) {
        $this->friends()->detach($user->id);
        $user->friends()->detach($this->id);
    }

    public function scopeTurmaNotasFaltas(Builder $query) {
        return $query
            ->select(
                'disciplinas.nome',
                'turmas.id',
                DB::raw('SUM(atividades.valor) as valor'),
                DB::raw('SUM(notas.nota) as nota'),
                DB::raw('COUNT(aulas.id) as aulas'),
                DB::raw('COUNT(ausencias.id) as faltas')
            )
            ->join('users_turmas', 'users.id', '=', 'users_turmas.user_id')
            ->join('turmas', 'turmas.id', '=', 'users_turmas.turma_id')
            ->leftjoin('aulas', 'turmas.id', '=', 'aulas.turma_id')
            ->leftjoin('ausencias', 'ausencias.aula_id', '=', 'aulas.id')
            ->leftjoin('atividades', 'atividades.turma_id', '=', 'turmas.id')
            ->leftjoin('notas', 'notas.atividade_id', '=', 'atividades.id')
            ->join('curso_instituicao_disciplinas', 'curso_instituicao_disciplinas.id', '=', 'turmas.instituicao_curso_disciplina_id')
            ->join('disciplinas', 'disciplinas.id', '=', 'curso_instituicao_disciplinas.disciplina_id')
            ->where('users.id', '=', $this->id)
            ->where(function ($query) {
                return $query->where('notas.user_id', '=', $this->id)
                    ->orWhere('notas.user_id', '=', null);
            })
            ->where(function ($query) {
                return $query->where('ausencias.user_id', '=', $this->id)
                    ->orWhere('ausencias.user_id', '=', null);
            })
            ->where(function ($query) {
                return $query->where('aulas.cancelada', '=', 0)
                    ->orWhere('aulas.cancelada', '=', null);
            })
            ->where(function ($query) {
                return $query->where('atividades.cancelada', '=', '0')
                    ->orWhere('atividades.cancelada', '=', null);
            })
            ->groupBy('turmas.id');
    }
}
