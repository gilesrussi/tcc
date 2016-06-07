<?php

namespace App\Http\Controllers;

use App\Instituicao;
use Illuminate\Http\Request;

use App\Http\Requests;

class InstituicaoController extends Controller
{
    public function show(Instituicao $instituicao) {
        return view('instituicao.show', compact('instituicao'));
    }
}
