<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest()) {
            return view('welcome');
        }
        return view('home.index');
    }

    public function notificacoes() {
        $notificacoes = Auth::user()->notificacoes()->get();
        return view('home.notificacoes', compact('notificacoes'));
    }

    public function pedidos_amizade() {
        $pedidos_amizade = Auth::user()->friends()->wherePivot('accepted', 0)->get();
        return view('home.pedidos_amizade', compact('pedidos_amizade'));
    }

    public function calendario() {
        return view('home.calendario');
    }

    public function anotacoes() {
        $turmas = Auth::user()
            ->turmas()
            ->with(array('aulas' => function($query) {
                $query->with(array('anotacoes' => function($query) {
                    $query->where('user_id', Auth::user()->id);
                }));
            }), 'cid.disciplina')
            ->get();

        return view('home.anotacoes', compact('turmas'));
    }

    public function faltas() {
        return view('home.faltas');
    }

    public function notas() {
        return view('home.notas');
    }
}
