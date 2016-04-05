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
        return view('profile/index', array('user' => Auth::user()));
    }

    /**
     * @param User $user
     * @return User
     */

    public function show(User $user) {
        if(Auth::user()->id == $user->id) {
            return redirect('profile/');
        }
        return view('profile/index', array('user' => $user));
    }

    public function edit() {
        return Auth::user();
    }

    public function update(Request $request) {
        return $request;
    }

    public function addFriend(Request $request) {
        Auth::user()->friends()->attach($request->user_id);
        return redirect("profile/$request->user_id");
    }

}
