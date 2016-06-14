<?php

namespace App\Http\Controllers;

use App\Atividade;
use App\TipoAtividade;
use App\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;

class AtividadeController extends Controller
{

    public function __construct() {
        $this->middleware('participa_da_turma');
        $this->middleware('atividade_da_turma', array(
            'only' => array(
                'show'
            )
        ));
    }
    
    public function index(Turma $turma) {
        return view('atividade.index', array('turma' => $turma));
    }

    public function show(Turma $turma, Atividade $atividade) {
        return view('atividade.show', array(
            'turma' => $turma,
            'atividade' => $atividade
        ));
    }

    public function create(Turma $turma) {
        $tipo_atividade = TipoAtividade::lists('nome', 'id');
        return view('atividade.create', array(
            'turma' => $turma,
            'tipo_atividade' => $tipo_atividade
        ));
    }

    public function store(Turma $turma, Request $request) {
        $atividade = new Atividade($request->all());
        $atividade->turma_id = $turma->id;
        $atividade->save();
        return redirect()->action('AtividadeController@index', array('turma' => $turma->id));
    }

    public function edit(Turma $turma, Atividade $atividade) {
        $tipo_atividade = TipoAtividade::lists('nome', 'id');
        return view('atividade.edit', array(
            'turma' => $turma,
            'atividade' => $atividade,
            'tipo_atividade' => $tipo_atividade
        ));
    }

    public function update(Request $request, Turma $turma, Atividade $atividade) {
        $atividade->update($request->all());

        return redirect()->action('AtividadeController@show', array('turma' => $turma->id, 'atividade' => $atividade->id));
    }

    public function cancelar(Turma $turma, Atividade $atividade) {
        $atividade->cancelar();
        return redirect()->back();
    }

    public function descancelar(Turma $turma, Atividade $atividade) {
        $atividade->descancelar();
        return redirect()->back();
    }
}
