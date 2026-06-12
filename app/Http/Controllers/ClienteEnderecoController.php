<?php

namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class ClienteEnderecoController extends Controller
{
    public function index()
    {
        $enderecos = Endereco::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('client.addresses', compact('enderecos'));
    }

    public function create()
    {
        return view('client.address-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'cep' => 'required|string|max:20',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'complemento' => 'nullable|string|max:255',
        ]);

        Endereco::create([
            'user_id' => auth()->id(),
            'nome' => $request->nome,
            'telefone' => preg_replace('/\D/', '', $request->telefone),
            'cep' => preg_replace('/\D/', '', $request->cep),
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => strtoupper($request->estado),
            'complemento' => $request->complemento,
            'principal' => false,
        ]);

        return redirect()
            ->route('cliente.enderecos')
            ->with('success', 'Endereço cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $endereco = Endereco::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return view('client.address-edit', compact('endereco'));
    }

    public function update(Request $request, $id)
    {
        $endereco = Endereco::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'cep' => 'required|string|max:20',
            'rua' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'bairro' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:2',
            'complemento' => 'nullable|string|max:255',
        ]);

        $endereco->update([
            'nome' => $request->nome,
            'telefone' => preg_replace('/\D/', '', $request->telefone),
            'cep' => preg_replace('/\D/', '', $request->cep),
            'rua' => $request->rua,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'cidade' => $request->cidade,
            'estado' => strtoupper($request->estado),
            'complemento' => $request->complemento,
        ]);

        return redirect()
            ->route('cliente.enderecos')
            ->with('success', 'Endereço atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $endereco = Endereco::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $endereco->delete();

        return redirect()
            ->route('cliente.enderecos')
            ->with('success', 'Endereço excluído com sucesso!');
    }
}