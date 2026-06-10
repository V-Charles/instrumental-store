<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function showResetForm($token)
    {
        return view('auth.reset-password', [
            'token' => $token
        ]);
    }

    public function resetPassword(Request $request)
    {
        return back()->with(
            'success',
            'Funcionalidade de redefinição de senha será implementada no Commit 4.'
        );
    }
}