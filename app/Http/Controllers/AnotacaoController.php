<?php

namespace App\Http\Controllers;

use App\Anotacao;
use App\Aula;
use App\Turma;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class AnotacaoController extends Controller
{

    public function __construct() {
        $this->middleware('participa_da_turma');
        $this->middleware('aula_da_turma', array(
            'except' => array(
                'index',
            )
        ));
    }

    public function create(Turma $turma, Aula $aula) {
        return view('anotacao.create', compact('turma', 'aula'));
    }

    public function store(Turma $turma, Aula $aula, Request $request) {
        $anotacao = new Anotacao($request->all());
        $anotacao = $anotacao->associar($aula, Auth::user());
        $anotacao->save();

        return redirect()->action('AulaController@show', array('turma' => $turma->id, 'aula' => $aula->id));
    }

    public function edit(Turma $turma, Aula $aula) {
        $anotacao = Anotacao::anotacaoDoUsuario($aula, Auth::user())->get()->first();
        return view('anotacao.edit', compact('turma', 'aula', 'anotacao'));
    }

    public function update(Turma $turma, Aula $aula, Request $request) {
        $anotacao = Anotacao::anotacaoDoUsuario($aula, Auth::user())->get()->first();
        $anotacao->update($request->all());
        return redirect()->action('AulaController@show', array('turma' => $turma->id, 'aula' => $aula->id));
    }

    public function show(Turma $turma, Aula $aula, Anotacao $anotacao) {
        return view('anotacao.show', compact('turma', 'aula', 'anotacao'));
    }

    public function index(Turma $turma) {
        $anotacoes = Anotacao::doUsuarioNaTurma(Auth::user(), $turma)->orderBy('aulas.dia')->get();
        return view('anotacao.index', compact('turma', 'anotacoes'));
    }


}
