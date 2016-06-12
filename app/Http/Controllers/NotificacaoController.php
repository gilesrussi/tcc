<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class NotificacaoController extends Controller
{
    public function index() {
        $n = Auth::user()->notificacoes();
        $notificacoes = $n->get();
        return view('notificacao.index', compact('notificacoes'));
    }
}
