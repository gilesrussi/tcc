<?php

namespace App\Http\Controllers;

use App\Turma;
use Illuminate\Http\Request;

use App\Http\Requests;

class AtividadeController extends Controller
{



    public function index(Turma $turma) {
        return $turma;
    }
}
