<?php

namespace App\Http\Middleware;

use App\Turma;
use Closure;
use Illuminate\Support\Facades\Auth;

class AulaDaTurma
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $turma = $request->route()->parameters()['turma'];
        $aula = $request->route()->parameters()['aula'];

        if ( $aula->turma_id != $turma->id) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->action('HomeController@index');
            }
        }

        return $next($request);
    }
}


