<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\Nota;
use App\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class NotaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('participa_da_turma');
        $this->middleware('atividade_da_turma', array(
            'except' => array(
                'index'
            )
        ));
    }


    public function create(Turma $turma, Atividade $atividade) {

        return view('nota.create', compact('turma', 'atividade'));
    }

    public function store(Turma $turma, Atividade $atividade, Request $request) {
        $nota = new Nota($request->all());
        $nota = $nota->associar($atividade, Auth::user());
        $nota->save();

        return redirect()->action('AtividadeController@show', array('turma' => $turma->id, 'atividade' => $atividade->id));
    }

    public function edit(Turma $turma, Atividade $atividade) {
        $nota = Nota::notaDoUsuario($atividade, Auth::user())->get()->first();
        if($nota == null) {
            return redirect()->action('NotaController@create', array('turma' => $turma->id, 'atividade' => $atividade->id));
        }
        return view('nota.edit', compact('turma', 'atividade', 'nota'));
    }

    public function update(Turma $turma, Atividade $atividade, Request $request) {
        $nota = Nota::notaDoUsuario($atividade, Auth::user())->get()->first();
        $nota->update($request->all());
        return redirect()->action('AtividadeController@show', array('turma' => $turma->id, 'atividade' => $atividade->id));
    }

    public function index(Turma $turma) {
        $notas = Nota::doUsuarioNaTurma(Auth::user(), $turma)->orderBy('atividades.data')->get();
        return view('nota.index', compact('turma', 'notas'));
    }

}
