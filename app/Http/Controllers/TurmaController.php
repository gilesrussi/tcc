<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Disciplina;
use App\Instituicao;
use App\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;

class TurmaController extends Controller
{

    public function find() {
        $instituicoes = Instituicao::lists('nome', 'id');
        $cursos = Curso::lists('nome', 'id');
        $disciplinas = Disciplina::lists('nome', 'id');

        return view('turma/find', array(
            'instituicoes' => $instituicoes,
            'cursos' => $cursos,
            'disciplinas' => $disciplinas
        ));
    }

    public function search(Request $request) {
        return Turma::withFilters($request->instituicao, $request->curso, $request->disciplina)->get();
    }

    public function create(Request $request) {
        $instituicoes = Instituicao::lists('nome', 'id');
        $cursos = Curso::lists('nome', 'id');
        $disciplinas = Disciplina::lists('nome', 'id');
        $turma = new Turma;
        $turma->instituicao = $request->instituicao;
        $turma->curso = $request->curso;
        $turma->disciplina = $request->disciplina;
        return view('turma/create', array(
            'instituicoes' => $instituicoes,
            'cursos' => $cursos,
            'disciplinas' => $disciplinas,
            'turma' => $turma
        ))->withInput($request);
    }
}
