<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        $pedidos = Pedido::latest()->get();
        
        $totalPedidos = Pedido::count();
        $novosPedidos = Pedido::where('status', 'pendente')->count();
        $pedidosFinalizados = Pedido::where('status', 'entregue')->count();
        $pedidosCancelados = Pedido::where('status', 'cancelado')->count();

        return view('admin.pedidos.index', compact(
            'pedidos', 
            'totalPedidos', 
            'novosPedidos', 
            'pedidosFinalizados', 
            'pedidosCancelados'
        ));
    }
}