<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ClienteConfiguracaoController extends Controller
{
    public function index()
    {
        return view('client.settings');
    }

    public function atualizarSenha(Request $request)
    {
        $request->validate([
            'senha_atual' => 'required',
            'nova_senha' => 'required|min:6|confirmed',
        ]);

        $cliente = auth()->user();

        if (!Hash::check($request->senha_atual, $cliente->password)) {
            return redirect()
                ->route('cliente.configuracao')
                ->withErrors(['senha_atual' => 'A senha atual está incorreta.']);
        }

        $cliente->password = Hash::make($request->nova_senha);
        $cliente->save();

        return redirect()
            ->route('cliente.configuracao')
            ->with('success', 'Senha alterada com sucesso!');
    }

    public function atualizarIdioma(Request $request)
    {
        $request->validate([
            'idioma' => 'required|in:pt,en',
        ]);

        session(['locale' => $request->idioma]);

        return redirect()
            ->route('cliente.configuracao')
            ->with('success', 'Idioma atualizado com sucesso!');
    }

    public function excluirConta(Request $request)
    {
        $request->validate([
            'senha_exclusao' => 'required',
        ]);

        $cliente = auth()->user();

        if (!Hash::check($request->senha_exclusao, $cliente->password)) {
            return redirect()
                ->route('cliente.configuracao')
                ->withErrors(['senha_exclusao' => 'A senha informada está incorreta.']);
        }

        if (!empty($cliente->foto)) {
            Storage::disk('public')->delete($cliente->foto);
        }

        Auth::logout();

        $cliente->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Conta excluída com sucesso.');
    }
}