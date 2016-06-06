<?php

namespace App\Http\Middleware;

use Closure;

class AtividadeDaTurma
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
        $atividade = $request->route()->parameters()['atividade'];

        if ( $atividade->turma_id != $turma->id) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->action('HomeController@index');
            }
        }

        return $next($request);
    }
}
