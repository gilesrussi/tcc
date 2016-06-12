<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

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
    public function friends()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_of')->withPivot('accepted')->withTimestamps();
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
        return $this->belongsToMany('App\Notificacao', 'notificacaos_users')->withPivot('visto')->withTimestamps();
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
}
