<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class NotificacaoController extends Controller
{
    public function index() {
        $notificacoes = Auth::user()->notificacoes()->get();
        return view('notificacao.index', compact('notificacoes'));
    }
}
