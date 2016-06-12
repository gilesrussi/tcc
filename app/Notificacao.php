<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Notificacao extends Model
{
    protected $table = 'notificacoes';

    protected $fillable = ['mensagem'];

    public function usuarios() {
        return $this->belongsToMany('App\User', 'notificacaos_users')->withPivot('visto')->withTimestamps();
    }

    public function paraTurma(Turma $turma) {
        $idUsers = $turma->participantes()->get();

        $idUsers = $idUsers->diff([Auth::user()]);
        if($idUsers->count() > 0) {
            $this->save();
            $this->usuarios()->attach($idUsers);
        }
    }

    public function paraPessoa(User $user) {
        $this->save();
        $this->usuarios()->attach($user->id);
    }

    public function foiVisto() {
        if($this->pivot->visto == false) {
            $this->usuarios()->updateExistingPivot(Auth::user()->id, array('visto' => true));
            return true;
        } else {
            return false;
        }
    }
}
