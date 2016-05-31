<?php

namespace App\Http\Controllers;

use App\Aula;
use App\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;

class AulaController extends Controller
{
    public function index(Turma $turma) {
        return view('aula.index', array(
            'turma' => $turma,
        ));
    }

    public function create(Turma $turma) {
        return view('aula.create', array('turma' => $turma));
    }

    public function store(Turma $turma, Request $request) {
        $turma->adicionarAula($request);
    }

    public function edit(Turma $turma, Aula $aula) {
        return view('aula.edit', array(
            'turma' => $turma,
            'aula' => $aula
        ));
    }

    public function update(Request $request, Turma $turma, Aula $aula) {

    }
}
