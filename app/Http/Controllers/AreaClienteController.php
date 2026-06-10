<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
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
            'senha' => 'nullable|string|min:6',
        ]);

        if (Schema::hasColumn($cliente->getTable(), 'name')) {
            $cliente->name = $request->name;
        }

        if (Schema::hasColumn($cliente->getTable(), 'nome')) {
            $cliente->nome = $request->name;
        }

        if (Schema::hasColumn($cliente->getTable(), 'email')) {
            $cliente->email = $request->email;
        }

        if (Schema::hasColumn($cliente->getTable(), 'telefone')) {
            $cliente->telefone = $request->telefone;
        }

        if (Schema::hasColumn($cliente->getTable(), 'cpf')) {
            $cliente->cpf = $request->cpf;
        }

        if (Schema::hasColumn($cliente->getTable(), 'data_nascimento')) {
            $cliente->data_nascimento = $request->data_nascimento;
        }

        if (Schema::hasColumn($cliente->getTable(), 'sexo')) {
            $cliente->sexo = $request->sexo;
        }

        if ($request->filled('senha') && Schema::hasColumn($cliente->getTable(), 'password')) {
            $cliente->password = Hash::make($request->senha);
        }

        $cliente->save();

        return redirect()
            ->route('cliente.dados')
            ->with('success', 'Dados pessoais atualizados com sucesso!');
    }

    public function configuracao()
    {
        return view('client.settings');
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