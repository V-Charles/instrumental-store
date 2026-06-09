<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pedido::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('codigo', 'like', "%{$search}%")
                  ->orWhere('cliente_nome', 'like', "%{$search}%")
                  ->orWhere('cliente_email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pedidos = $query->latest()->get();
        
        $totalPedidos = Pedido::count();
        $novosPedidos = Pedido::where('status', 'pendente')->count();
        $pedidosFinalizados = Pedido::where('status', 'entregue')->count();
        $pedidosCancelados = Pedido::where('status', 'cancelado')->count();

        if ($request->wantsJson()) {
            $pedidos->transform(function($pedido) {
                $pedido->data_formatada = $pedido->created_at->format('d/m/Y H:i');
                $pedido->total_formatado = number_format($pedido->total, 2, ',', '.');
                $pedido->status_classe = strtolower($pedido->status);
                $pedido->status_texto = ucfirst($pedido->status);
                return $pedido;
            });
            return response()->json($pedidos);
        }

        return view('admin.pedidos.index', compact(
            'pedidos', 
            'totalPedidos', 
            'novosPedidos', 
            'pedidosFinalizados', 
            'pedidosCancelados'
        ));
    }

    public function show($id)
    {
        $pedido = Pedido::with('itens.produto')->findOrFail($id);
        
        return view('admin.pedidos.show', compact('pedido'));
    }

public function meusPedidos()
{
    $pedidos = Pedido::with('itens.produto')
        ->latest()
        ->get();

    return view(
        'client.orders',
        compact('pedidos')
    );
}

public function detalheCliente($id)
{
    $pedido = Pedido::with('itens.produto')
        ->findOrFail($id);

    return view('client.order-detail', compact('pedido'));
}

public function atualizarStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pendente,pago,enviado,entregue'
    ]);

    $pedido = Pedido::findOrFail($id);

    $pedido->update([
        'status' => $request->status
    ]);

    return back()->with(
        'success',
        'Status atualizado com sucesso.'
    );
}
}