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
        if(Auth::user()->isFriend($user)) {
            return view('profile/showFriend', array('user' => $user));
        }

        if(Auth::user()->id == $user->id) {
            return view('profile/showMe', array('user' => $user));
        }

        if(Auth::user()->canRespondTo($user)) {
            return view('profile/showAccept', array('user' => $user));
        }
        
        if($user->noEntry(Auth::user())) {
            return view('profile/showPerson', array('user' => $user));
        }

        return view('profile/showWaitingForResponse', array('user' => $user));
        
    }

    public function edit() {
        return view('profile.edit');
    }

    public function update(Request $request) {
        $user = Auth::user();
        // getting all of the post data
        $file = array('avatar' => $request->file('avatar'));

        // vendo se é válido
        if ($file['avatar']->isValid()) {
            $destinationPath = 'images/profile'; // upload path
            $extension = $file['avatar']->getClientOriginalExtension(); // getting image extension
            $fileName = rand(1000000,9999999).'.'.$extension; // renameing image
            $file['avatar']->move(storage_path($destinationPath), $fileName); // uploading file to given path
            $user->avatar = 'images/profile/' . $fileName;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
        }
        else {
            dd();
            return false;
        }
        return redirect()->action('ProfileController@show', $user->id);
    }

    public function dealWithFriendship(Request $request) {
        //caso já seja amigo, só pode remover. so sorry.
        $user = User::find($request->user_id);
        if(Auth::user()->isFriend($user)) {
            Auth::user()->breakFriendship($user);
        }

        //caso esteja respondendo um pedido de amizade, tem duas opções:
        //aceita ou rejeita :D
        elseif(Auth::user()->canRespondTo($user)) {
            if($request->aceitar == 1) {
                Auth::user()->acceptFriendshipRequest($user);
            } else {
                Auth::user()->rejectFriendshipRequest($user);
            }
        }

        // enviar pedido de amizade :D
        elseif($user->noEntry(Auth::user())) {
            Auth::user()->sendFriendshipRequest($user);
        }

        // cancelar pedido de amizade :D
        else {
            Auth::user()->cancelFriendshipRequest($user);
        }

        return redirect()->action("ProfileController@show", [$request->user_id]);
    }

}
