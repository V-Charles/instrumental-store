<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Pedido;
use App\Models\ItemPedido;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function adicionar($id)
    {
        $produto = Produto::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantidade']++;
        } else {
            $cart[$id] = [
                'id' => $produto->id,
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'imagem' => $produto->imagem_principal,
                'quantidade' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->back()
            ->with('success', 'Produto adicionado ao carrinho!');
    }

    public function remover($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('cart')
            ->with('success', 'Produto removido do carrinho!');
    }

    public function aumentar($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantidade']++;
        }

        session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    public function diminuir($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($cart[$id]['quantidade'] > 1) {
                $cart[$id]['quantidade']--;
            } else {
                unset($cart[$id]);
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart');
    }

    public function finalizar(Request $request)
    {
        $request->validate([
            'forma_pagamento' => 'required',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()
                ->route('cart')
                ->with('error', 'O carrinho está vazio.');
        }

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        $pedido = Pedido::create([
            'codigo' => 'PED-' . strtoupper(uniqid()),
            'total' => $total,
            'status' => 'pendente',
            'forma_pagamento' => $request->forma_pagamento,
            'cliente_nome' => 'Cliente Teste',
            'cliente_email' => 'cliente@teste.com',
        ]);

        foreach ($cart as $item) {
            ItemPedido::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $item['id'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco'],
            ]);
        }

        session()->forget('cart');

        if ($request->forma_pagamento === 'pix') {
            return redirect()->route('payment.pix');
        }

        return redirect()->route('order.success');
    }
}