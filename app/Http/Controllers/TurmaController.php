<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Disciplina;
use App\Instituicao;
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
}
