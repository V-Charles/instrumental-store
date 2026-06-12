<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Pedido;
use App\Models\ItemPedido;
use Illuminate\Http\Request;
use App\Models\Cartao;
use App\Models\Endereco;
use Illuminate\Support\Facades\Http;

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

    public function adicionar(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);
        $cart = $request->session()->get('cart', []);

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

        $request->session()->put('cart', $cart);
        $request->session()->save(); 

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

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Seu carrinho está vazio.');
        }

        $cartoesCadastrados = Cartao::where('user_id', auth()->id())->get();
        $enderecosCadastrados = Endereco::where('user_id', auth()->id())->get();

        return view('payment.index', compact('cartoesCadastrados', 'enderecosCadastrados'));
    }

    public function finalizar(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
            'delivery_address' => 'required',
            'registered_card' => 'required_if:payment_method,credito,debito',
        ], [
            'payment_method.required' => 'Escolha uma forma de pagamento.',
            'delivery_address.required' => 'Escolha um endereço de entrega.',
            'registered_card.required_if' => 'Escolha um cartão para o pagamento.',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'O carrinho está vazio.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }

        $pedido = Pedido::create([
            'codigo' => 'PED-' . strtoupper(uniqid()),
            'total' => $total,
            'status' => 'pendente',
            'forma_pagamento' => $request->payment_method,
            'cliente_nome' => auth()->user()->name,
            'cliente_email' => auth()->user()->email,
        ]);

        foreach ($cart as $item) {
            ItemPedido::create([
                'pedido_id' => $pedido->id,
                'produto_id' => $item['id'],
                'quantidade' => $item['quantidade'],
                'preco_unitario' => $item['preco'],
            ]);
        }

        if ($request->payment_method === 'pix') {
            $token = config('services.mercadopago.access_token');

            $response = Http::withToken($token)
                ->withHeaders(['X-Idempotency-Key' => uniqid()])
                ->post('https://api.mercadopago.com/v1/payments', [
                    'transaction_amount' => (float) $total,
                    'description' => 'Compra Loja - ' . $pedido->codigo,
                    'payment_method_id' => 'pix',
                    'payer' => [
                        'email' => auth()->user()->email,
                        'first_name' => explode(' ', auth()->user()->name)[0],
                        'last_name' => str_contains(auth()->user()->name, ' ') ? substr(auth()->user()->name, strpos(auth()->user()->name, ' ') + 1) : 'Silva',
                    ]
                ]);

            if ($response->successful()) {
                $dadosPagamento = $response->json();
                $pedido->update([
                    'transaction_id' => $dadosPagamento['id'],
                    'pix_copia_cola' => $dadosPagamento['point_of_interaction']['transaction_data']['qr_code'],
                    'pix_qr_code_base64' => $dadosPagamento['point_of_interaction']['transaction_data']['qr_code_base64'],
                ]);

                session()->forget('cart');

                return redirect()->route('payment.pix', $pedido->id);
            } else {
                $pedido->delete();
                return redirect()->back()->withErrors(['api_error' => 'Falha ao gerar o Pix com o Mercado Pago. Verifique suas credenciais de teste.']);
            }
        }

        session()->forget('cart');
        return redirect()->route('order.success');
    }

    public function exibirPix($id)
    {
        $pedido = Pedido::where('user_id', auth()->id())->where('id', $id)->firstOrFail();
        return view('payment.pix', compact('pedido'));
    }
}