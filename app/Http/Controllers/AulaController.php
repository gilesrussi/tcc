<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;

class AulaController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('participa_da_turma');
        $this->middleware('aula_da_turma', array(
            'only' => array(
                'show'
            )
        ));
    }

    public function index(Turma $turma) {
        return view('aula.index', array(
            'turma' => $turma,
        ));
    }

    public function show(Turma $turma, Aula $aula) {
        return view('aula.show', array(
            'turma' => $turma,
            'aula' => $aula
        ));
    }

    public function create(Turma $turma) {
        return view('aula.create', array('turma' => $turma));
    }

    public function store(Turma $turma, Request $request) {
        $aula = new Aula($request->all());
        $aula->turma_id = $turma->id;
        $aula->save();
        return redirect()->action('AulaController@index', array('turma' => $turma->id));
    }

    public function edit(Turma $turma, Aula $aula) {
        return view('aula.edit', array(
            'turma' => $turma,
            'aula' => $aula
        ));
    }

    public function update(Request $request, Turma $turma, Aula $aula) {
        $aula->update($request->all());

        return redirect()->action('AulaController@show', array('turma' => $turma->id, 'aula' => $aula->id));
    }

    public function cancelar(Turma $turma, Aula $aula) {
        $aula->cancelar();
        return redirect()->back();
    }

    public function descancelar(Turma $turma, Aula $aula) {
        $aula->descancelar();
        return redirect()->back();
    }
}
