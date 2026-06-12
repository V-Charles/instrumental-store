<?php

namespace App\Http\Controllers;

use App\Models\Cartao;
use Illuminate\Http\Request;

class ClienteCartaoController extends Controller
{
    public function index()
    {
        $cartoes = Cartao::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('client.cards', compact('cartoes'));
    }

    public function create()
    {
        return view('client.card-create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'apelido_cartao' => 'nullable|string|max:255',
            'tipo_cartao' => 'required|string|in:credito,debito',
            'nome_impresso' => 'required|string|max:255',
            'numero_cartao' => 'required|string|max:25',
            'validade' => 'required|string|max:7',
            'codigo_seguranca' => 'nullable|string|max:4',
        ]);

        $numeroLimpo = preg_replace('/\D/', '', $request->numero_cartao);

        Cartao::create([
            'user_id' => auth()->id(),
            'apelido_cartao' => $request->apelido_cartao,
            'tipo_cartao' => $request->tipo_cartao,
            'nome_impresso' => strtoupper($request->nome_impresso),
            'numero_cartao' => $numeroLimpo,
            'validade' => $request->validade,
            'codigo_seguranca' => $request->codigo_seguranca,
            'bandeira' => $this->identificarBandeira($numeroLimpo),
            'principal' => false,
        ]);

        return redirect()
            ->route('cliente.cartoes')
            ->with('success', 'Cartão cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $cartao = Cartao::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        return view('client.card-edit', compact('cartao'));
    }

    public function update(Request $request, $id)
    {
        $cartao = Cartao::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $request->validate([
            'apelido_cartao' => 'nullable|string|max:255',
            'tipo_cartao' => 'required|string|in:credito,debito',
            'nome_impresso' => 'required|string|max:255',
            'numero_cartao' => 'required|string|max:25',
            'validade' => 'required|string|max:7',
            'codigo_seguranca' => 'nullable|string|max:4',
        ]);

        $numeroLimpo = preg_replace('/\D/', '', $request->numero_cartao);

        $cartao->update([
            'apelido_cartao' => $request->apelido_cartao,
            'tipo_cartao' => $request->tipo_cartao,
            'nome_impresso' => strtoupper($request->nome_impresso),
            'numero_cartao' => $numeroLimpo,
            'validade' => $request->validade,
            'codigo_seguranca' => $request->codigo_seguranca,
            'bandeira' => $this->identificarBandeira($numeroLimpo),
        ]);

        return redirect()
            ->route('cliente.cartoes')
            ->with('success', 'Cartão atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $cartao = Cartao::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $cartao->delete();

        return redirect()
            ->route('cliente.cartoes')
            ->with('success', 'Cartão excluído com sucesso!');
    }

    private function identificarBandeira($numero)
    {
        if (str_starts_with($numero, '4')) {
            return 'Visa';
        }

        if (preg_match('/^5[1-5]/', $numero)) {
            return 'Mastercard';
        }

        if (preg_match('/^3[47]/', $numero)) {
            return 'American Express';
        }

        if (preg_match('/^6/', $numero)) {
            return 'Elo';
        }

        return 'Cartão';
    }
}