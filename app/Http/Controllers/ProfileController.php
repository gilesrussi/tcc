<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;
Use App\User;

class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     *
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return mixed
     */

    public function index() {
        return redirect()->action('ProfileController@show', [Auth::user()->id]);
    }

    /**
     * Função que retorna a view de acordo com o nivel de amizade:
     *  com amizade;
     *  pedido pendente;
     *  aguardando resposta;
     *  meu perfil;
     *  desconhecido.
     *
     * @param User $user
     * @return User
     */

    public function show(User $user) {
        if(Auth::user()->hasFriend($user)) {
            return view('profile/showFriend', array('user' => $user));
        }

        if(Auth::user()->id == $user->id) {
            return view('profile/showMe', array('user' => $user));
        }

        if(Auth::user()->waitingAcceptance($user)) {
            return view('profile/showAccept', array('user' => $user));
        }
        
        if($user->noEntry(Auth::user())) {
            return view('profile/showPerson', array('user' => $user));
        }

        return view('profile/showWaitingForResponse', array('user' => $user));
        
    }

    public function edit() {
        return Auth::user();
    }

    public function update(Request $request) {
        return $request;
    }

    public function dealWithFriendship(Request $request) {
        //caso já seja amigo, só pode remover. so sorry.
        $user = User::find($request->user_id);
        if(Auth::user()->hasFriend($user)) {
            Auth::user()->breakFriendship($user);
        }

        //caso esteja respondendo um pedido de amizade, tem duas opções:
        //aceita ou rejeita :D
        elseif(Auth::user()->waitingAcceptance($user)) {
            if($request->aceitar == 1) {
                $user->friends()->attach(Auth::user()->id, array('accepted' => 1));
                Auth::user()->friends()->updateExistingPivot($request->user_id, array('accepted' => 1));
            } else {
                Auth::user()->friends()->detach($request->user_id);
            }
        }

        // enviar pedido de amizade :D
        elseif($user->noEntry(Auth::user())) {
            $user->friends()->attach(Auth::user()->id);
        }

        // cancelar pedido de amizade :D
        else {
            $user->friends()->detach(Auth::user()->id);
        }

        return redirect()->action("ProfileController@show", [$request->user_id]);
    }

}
