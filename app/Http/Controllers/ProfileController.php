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
     * @param User $user
     * @return User
     */

    public function show(User $user) {
        if(Auth::user()->hasFriend($user)) {
            return view('profile/showFriend');
        }
        if(Auth::user()->id == $user->id) {
            return view('profile/showMe');
        }
        if(Auth::user()->noEntry($user)) {
            return view('profile/showRandom', array('user' => $user));
        }



    }

    public function edit() {
        return Auth::user();
    }

    public function update(Request $request) {
        return $request;
    }

    public function dealWithFriendship(Request $request) {
        //Auth::user()->friends()->attach($request->user_id);
        return redirect("profile", [$request->user_id]);
    }

}
