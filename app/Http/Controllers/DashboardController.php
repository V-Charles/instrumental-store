<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Cliente;
use App\Models\Pagamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $seteDiasAtras = Carbon::now()->subDays(7);

        $receitaTotal = Pagamento::where('status', 'aprovado')->sum('valor');
        $receitaSemana = Pagamento::where('status', 'aprovado')->where('created_at', '>=', $seteDiasAtras)->sum('valor');
        
        $totalClientes = Cliente::count();
        $totalProdutos = Produto::count();
        $produtosEmEstoque = Produto::where('estoque', '>', 0)->count();
        $produtosForaEstoque = Produto::where('estoque', '<=', 0)->count();
        $totalPedidos = Pedido::count();

        $ultimosPedidos = Pedido::with('pagamento')->latest()->take(10)->get();

        $vendasPorDia = Pagamento::where('status', 'aprovado')
            ->where('created_at', '>=', $seteDiasAtras)
            ->selectRaw('DATE(created_at) as data, SUM(valor) as total')
            ->groupBy('data')
            ->orderBy('data', 'asc')
            ->get();

        $labelsGrafico = [];
        $dadosGrafico = [];

        for ($i = 6; $i >= 0; $i--) {
            $data = Carbon::now()->subDays($i)->format('Y-m-d');
            $diaSemana = Carbon::now()->subDays($i)->locale('pt_BR')->shortDayName;
            
            $vendaDia = $vendasPorDia->firstWhere('data', $data);
            
            $labelsGrafico[] = ucfirst($diaSemana);
            $dadosGrafico[] = $vendaDia ? $vendaDia->total : 0;
        }

        return view('admin.dashboard.index', compact(
            'receitaTotal',
            'receitaSemana',
            'totalClientes',
            'totalProdutos',
            'produtosEmEstoque',
            'produtosForaEstoque',
            'totalPedidos',
            'ultimosPedidos',
            'labelsGrafico',
            'dadosGrafico'
        ));
    }
}