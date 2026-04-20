<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

    public function login(Request $request){
        // Lógica de validação de login
    }

    public function registerForm(){
        return view('auth.register');
    }

    public function register(Request $request){
        // Lógica de gravação de novo cliente
    }
}