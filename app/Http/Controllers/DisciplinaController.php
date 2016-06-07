<?php

namespace App\Http\Controllers;

use App\Disciplina;
use Illuminate\Http\Request;

use App\Http\Requests;

class DisciplinaController extends Controller
{
    public function show(Disciplina $disciplina) {
        return view('disciplina.show', compact('disciplina'));
    }
}
