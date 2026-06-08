<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckManagerAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->cargo === 'operador') {
            abort(403, 'Acesso negado. O seu nível de permissão não permite acessar este recurso.');
        }

        return $next($request);
    }
}