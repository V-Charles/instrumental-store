<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

class ClienteDadosController extends Controller
{
    public function index()
    {
        $cliente = auth()->user();

        return view('client.profile', compact('cliente'));
    }

    public function update(Request $request)
    {
        $cliente = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'cpf' => 'nullable|string|max:20',
            'data_nascimento' => 'nullable|date',
            'sexo' => 'nullable|string|max:30',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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

        if ($request->hasFile('foto') && Schema::hasColumn($cliente->getTable(), 'foto')) {
            if (!empty($cliente->foto)) {
                Storage::disk('public')->delete($cliente->foto);
            }

            $cliente->foto = $request->file('foto')->store('clientes', 'public');
        }

        $cliente->save();

        return redirect()
            ->route('cliente.dados')
            ->with('success', 'Dados pessoais atualizados com sucesso!');
    }
}