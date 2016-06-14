<?php

namespace App\Http\Controllers;

use App\CursoInstituicaoDisciplina;
use App\Disciplina;
use App\Material;
use App\Turma;
use Illuminate\Http\Request;
use Input;

use App\Http\Requests;

class MaterialController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('participa_da_turma', array(
            'except' => array(
                'show'
            )
        ));

    }

    public function index(Turma $turma) {
        $materiais = $turma->materiais()->get();
        $materiaisOutrasTurmas = Disciplina::where('disciplinas.id', $turma->cid->disciplina->id)->with('cid.turmas.materiais')->get()->first();

        return view('material.index', compact('turma', 'materiais', 'materiaisOutrasTurmas'));
    }

    public function create(Turma $turma) {
        return view('material.create', compact('turma'));
    }

    public function show(Turma $turma, Material $material) {
        return view('material.show', compact('turma', 'material'));
    }

    public function store(Turma $turma, Request $request) {
        $material = new Material();

        $this->checkUpload($material, $request);
        $material->nome = $request->nome;
        $material->descricao = $request->descricao;
        $material->turma_id = $turma->id;
        $material->save();
        return redirect()->action('MaterialController@index', $turma->id);
    }

    public function checkUpload(Material $material, Request $request) {
        // getting all of the post data
        $file = array('link' => $request->file('link'));

        // vendo se é válido
        if ($file['link']->isValid()) {
            $destinationPath = 'Materiais'; // upload path
            $extension = $file['link']->getClientOriginalExtension(); // getting image extension
            $fileName = rand(1000000,9999999).'.'.$extension; // renameing image
            $file['link']->move($destinationPath, $fileName); // uploading file to given path
            $material->link = $fileName;
            return true;
        }
        else {
            dd();
            return false;
        }

    }
}
