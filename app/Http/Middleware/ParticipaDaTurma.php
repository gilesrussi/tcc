<?php

namespace App\Http\Middleware;

use App\Turma;
use Closure;
use Illuminate\Support\Facades\Auth;

class ParticipaDaTurma
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
        if (! Auth::user()->participates($turma)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->action('TurmaController@show', array('turma' => $turma->id));
            }
        }

        return $next($request);
    }
}

