<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/admin/login');
        }

        $user = Auth::user();

        if (!$user->ativo || !in_array($user->cargo, ['admin', 'gerente', 'operador'])) {
            Auth::logout();
            return redirect('/admin/login')->withErrors([
                'email' => 'Acesso negado. Área restrita da equipe.'
            ]);
        }

        return $next($request);
    }
}