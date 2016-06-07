<?php

namespace App\Http\Controllers;

use App\Curso;
use Illuminate\Http\Request;

use App\Http\Requests;

class CursoController extends Controller
{
    public function show(Curso $curso) {
        return view('curso.show', compact('curso'));
    }
}
