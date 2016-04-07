<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function friends()
    {
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_of')->withPivot('accepted')->withTimestamps();
    }

    public function scopeTrueFriends($query, $search = 1) {
        $pivot = $this->friends()->getTable();

        $query->whereHas('friends', function ($q) use ($search, $pivot) {
            $q->where("{$pivot}.accepted", $search)
              ->where("{$pivot}.friend_of", $this->id);
        });

    }


    public function hasFriend(User $user) {
        return $this->friends()->where("friend_of", $user->id)->wherePivot("accepted", 1)->count();

    }

    public function waitingAcceptance(User $user) {
        return $this->friends()->where("friend_of", $user->id)->wherePivot('accepted', 0)->count();
    }

    public function noEntry(User $user) {
        return !((bool) $this->friends()->where("friend_of", $user->id)->count());
    }
}
