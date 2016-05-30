<?php

namespace App\Http\Controllers;

use App\Curso;
use App\Disciplina;
use App\Horarios;
use App\Instituicao;
use App\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class TurmaController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index() {
        $minhasTurmas = Auth::user()->turmas();
        return view('turma/index', array(
            'minhasTurmas' => $minhasTurmas
        ));
    }

    public function store(Request $request) {
        return $request->input();

    }

    public function join(Turma $turma) {
        Auth::user()->join($turma);
        return redirect()->action('TurmaController@show', $turma->id);
    }

    public function show(Turma $turma) {
        return view('turma/show', compact('turma'));
    }

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
        return Turma::withFilters($request->instituicao, $request->curso, $request->disciplina)->paginate(10);
    }

    public function create(Request $request) {
        $instituicoes = Instituicao::lists('nome', 'id');
        $cursos = Curso::lists('nome', 'id');
        $disciplinas = Disciplina::lists('nome', 'id');
        $turma = new Turma;
        $turma->instituicao = $request->instituicao;
        $turma->curso = $request->curso;
        $turma->disciplina = $request->disciplina;
        $horarios = Horarios::orderBy('hora')->get();
        return view('turma/create', array(
            'instituicoes' => $instituicoes,
            'cursos' => $cursos,
            'disciplinas' => $disciplinas,
            'turma' => $turma,
            'horarios' => $horarios
        ))->withInput($request);
    }
}
