<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN - LISTAGEM DE PEDIDOS
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $pedidos = Pedido::with(['itens.produto', 'pagamento'])
            ->latest()
            ->get();

        return view('admin.pedidos.index', compact('pedidos'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - DETALHE DO PEDIDO
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $pedido = Pedido::with(['itens.produto', 'pagamento', 'devolucao'])
            ->findOrFail($id);

        return view('admin.pedidos.show', compact('pedido'));
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN - ATUALIZAR STATUS DO PEDIDO
    |--------------------------------------------------------------------------
    */

    public function atualizarStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:50',
        ]);

        $pedido = Pedido::findOrFail($id);

        $pedido->status = $request->status;
        $pedido->save();

        return redirect()
            ->back()
            ->with('success', 'Status do pedido atualizado com sucesso!');
    }

    /*
    |--------------------------------------------------------------------------
    | CLIENTE - MEUS PEDIDOS
    |--------------------------------------------------------------------------
    */

    public function meusPedidos()
    {
        $pedidos = Pedido::with(['itens.produto'])
            ->where('cliente_email', auth()->user()->email)
            ->latest()
            ->get();

        return view('client.orders', compact('pedidos'));
    }

    /*
    |--------------------------------------------------------------------------
    | CLIENTE - DETALHE DO PEDIDO
    |--------------------------------------------------------------------------
    */

    public function detalheCliente($id)
    {
        $pedido = Pedido::with(['itens.produto'])
            ->where('cliente_email', auth()->user()->email)
            ->where('id', $id)
            ->firstOrFail();

        return view('client.order-detail', compact('pedido'));
    }
}