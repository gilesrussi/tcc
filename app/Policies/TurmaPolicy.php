<?php

namespace App\Policies;

use App\Turma;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TurmaPolicy
{
    use HandlesAuthorization;


    public function join(User $user, Turma $turma) {
        return ! $user->participates($turma);
    }

    public function post(User $user, Turma $turma) {
        return $user->participates($turma);
    }
}
