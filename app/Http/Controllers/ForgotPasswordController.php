<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        return back()->with(
            'success',
            'Funcionalidade de recuperação de senha será implementada no Commit 4.'
        );
    }
}