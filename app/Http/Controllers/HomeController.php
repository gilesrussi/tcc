<?php

namespace App\Http\Controllers;

use App\Anotacao;
use App\Atividade;
use App\Aula;
use App\Http\Requests;
use App\Turma;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', array(
            'except' => array('index')
        ));
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
        $hoje = new Carbon('today');
        $aulas = Aula::doUsuario(Auth::user(), $hoje)->with('turma.cid.disciplina')->limit(6)->get();
        $atividades = Atividade::doUsuario(Auth::user(), $hoje)->with('turma.cid.disciplina')->limit(6)->get();
        $anotacoes = Anotacao::dasTurmasDoUsuario(Auth::user())->with('aula.turma.cid.disciplina')->limit(6)->get();
        //$resumo = Auth::user()->turmaNotasFaltas()->get();
        return view('home.index', compact('aulas',  'atividades', 'anotacoes'));
    }

    public function notificacoes() {
        $notificacoes = Auth::user()->notificacoes()->get();
        return view('home.notificacoes', compact('notificacoes'));
    }

    public function pedidos_amizade() {
        $pedidos_amizade = Auth::user()->friends()->wherePivot('accepted', 0)->get();
        return view('home.pedidos_amizade', compact('pedidos_amizade'));
    }

    public function calendario($semana = 0) {
        $de = new Carbon('last sunday');
        $ate = new Carbon('next saturday');
        $de->addWeek($semana);
        $ate->addWeek($semana);
        $aulas = Aula::doUsuario(Auth::user(), $de, $ate)->with('turma.cid.disciplina')->get()->groupBy('dia');
        $atividades = Atividade::doUsuario(Auth::user(), $de, $ate)->with('turma.cid.disciplina', 'tipo_atividade')->get()->groupBy('dia');

        return view('home.calendario', compact('aulas', 'atividades', 'de', 'semana'));
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
        $turmas = Auth::user()
            ->turmas()
            ->with(array('aulas' => function($query) {
                $query->with(array('ausencias' => function($query) {
                    $query->where('user_id', Auth::user()->id);
                }));
            }), 'cid.disciplina')
            ->get();
        return view('home.faltas', compact('turmas'));
    }

    public function notas() {
        $turmas = Auth::user()
            ->turmas()
            ->with(array('atividades' => function($query) {
                $query->with(array('notas' => function($query) {
                    $query->where('user_id', Auth::user()->id);
                }));
            }), 'cid.disciplina')
            ->get();
        return view('home.notas', compact('turmas'));
    }
}
