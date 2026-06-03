<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        return view('cart', compact('cart'));
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

        return redirect()->back()
            ->with('success', 'Produto adicionado ao carrinho!');
    }
}