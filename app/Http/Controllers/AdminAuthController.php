<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function loginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credenciais)) {
            $user = Auth::user();
            
            if (!$user->ativo || !in_array($user->cargo, ['admin', 'gerente', 'operador'])) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Acesso negado. Esta área é restrita para funcionários.',
                ])->onlyInput('email');
            }

            $request->session()->regenerate();

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'email' => 'E-mail ou senha incorretos.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}