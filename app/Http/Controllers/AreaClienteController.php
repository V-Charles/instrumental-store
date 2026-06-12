<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AreaClienteController extends Controller
{
    public function perfil()
    {
        $cliente = auth()->user();

        return view('client.profile', compact('cliente'));
    }

    public function atualizarPerfil(Request $request)
    {
        $cliente = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'cpf' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
            'sexo' => 'nullable|string|max:30',
        ]);

        if (isset($cliente->name)) {
            $cliente->name = $request->name;
        }

        if (isset($cliente->nome)) {
            $cliente->nome = $request->name;
        }

        $cliente->email = $request->email;
        $cliente->telefone = $request->telefone;
        $cliente->cpf = $request->cpf;
        $cliente->data_nascimento = $request->data_nascimento;
        $cliente->sexo = $request->sexo;

        $cliente->save();

        return redirect()
            ->route('cliente.dados')
            ->with('success', 'Dados pessoais atualizados com sucesso!');
    }

    public function configuracao()
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

        Auth::logout();

        $cliente->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Conta excluída com sucesso.');
    }

    public function enderecos()
    {
        return view('client.addresses');
    }

    public function criarEndereco()
    {
        return view('client.address-create');
    }

    public function editarEndereco()
    {
        return view('client.address-edit');
    }

    public function cartoes()
    {
        return view('client.cards');
    }

    public function criarCartao()
    {
        return view('client.card-create');
    }

    public function editarCartao()
    {
        return view('client.card-edit');
    }

    public function favoritos()
    {
        return view('client.wishlist');
    }
}