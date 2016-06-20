<?php

namespace App\Http\Controllers;

use App\Disciplina;
use App\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;

class DisciplinaController extends Controller
{
    public function show(Disciplina $disciplina) {
        $turmas = Turma::daDisciplina($disciplina)->with('cid.disciplina', 'cid.curso', 'cid.instituicao')->get();
        return view('disciplina.show', compact('disciplina', 'turmas'));
    }
}
