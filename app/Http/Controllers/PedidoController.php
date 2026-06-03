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

        return view('admin.pedidos.index', compact('pedidos', 'totalPedidos'));
    }
}