<?php

namespace App\Http\Controllers;

use App\Ausencia;
use App\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Mockery\CountValidator\Exception;

class FaltaController extends Controller
{
    public function __construct() {
        $this->middleware('participa_da_turma');
    }

    public function index(Turma $turma) {
        $aulas = $turma->aulas()->get();
        $faltas = Ausencia::doUsuarioNaTurma(Auth::user(), $turma)->get();
        return view('falta.index', compact('turma', 'aulas', 'faltas'));
    }

    public function store(Turma $turma, Request $request) {
        $aulas_id = $turma->aulas()->select('aulas.id')->get()->pluck('id');

        foreach($aulas_id as $id) {
            if($request['falta'] && in_array($id, $request['falta'])) {
                if(! Ausencia::where(array('aula_id' => $id, 'user_id' => Auth::user()->id))->first()) {
                    $ausencia = new Ausencia;
                    $ausencia->user_id = Auth::user()->id;
                    $ausencia->aula_id = $id;
                    $ausencia->save();
                }
            } else {
                try
                {
                    Ausencia::where(array('aula_id' => $id, 'user_id' => Auth::user()->id))->delete();
                }
                catch (Exception $e) {

                }
            }
        }
        return redirect()->action('FaltaController@index', $turma->id);
    }
}
