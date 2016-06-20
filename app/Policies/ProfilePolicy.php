<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function seeDetails(User $logado, User $profile) {
        dd($logado->isFriend($profile));
        return ($logado->isFriend($profile));
    }
}
