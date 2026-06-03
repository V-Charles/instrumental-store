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
    public function index(Request $request)
    {
        $seteDiasAtras = Carbon::now()->subDays(7);
        $catorzeDiasAtras = Carbon::now()->subDays(14);

        if ($request->wantsJson()) {
            $query = Pedido::with('pagamento');

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('codigo', 'like', "%{$search}%")
                      ->orWhere('cliente_nome', 'like', "%{$search}%");
                });
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            $pedidos = $query->latest()->take(10)->get();

            $pedidos->transform(function($pedido) {
                $pedido->data_formatada = $pedido->created_at->format('d/m/Y');
                $pedido->valor_formatado = number_format($pedido->total, 2, ',', '.');
                $pedido->status_pagamento = ($pedido->pagamento && $pedido->pagamento->status == 'aprovado') ? 'pago' : 'nao_pago';
                $pedido->status_classe = strtolower($pedido->status);
                $pedido->status_texto = ucfirst($pedido->status);
                return $pedido;
            });

            return response()->json($pedidos);
        }

        $receitaTotal = Pagamento::where('status', 'aprovado')->sum('valor');
        $receitaSemana = Pagamento::where('status', 'aprovado')->where('created_at', '>=', $seteDiasAtras)->sum('valor');
        
        $totalClientes = Cliente::count();
        $totalProdutos = Produto::count();
        $produtosEmEstoque = Produto::where('estoque', '>', 0)->count();
        $produtosForaEstoque = Produto::where('estoque', '<=', 0)->count();
        $totalPedidos = Pedido::count();

        $ultimosPedidos = Pedido::with('pagamento')->latest()->take(10)->get();

        $vendasSemanaAtual = Pagamento::where('status', 'aprovado')
            ->where('created_at', '>=', $seteDiasAtras)
            ->selectRaw('DATE(created_at) as data, SUM(valor) as total')
            ->groupBy('data')
            ->get();

        $vendasSemanaAnterior = Pagamento::where('status', 'aprovado')
            ->whereBetween('created_at', [$catorzeDiasAtras, $seteDiasAtras])
            ->selectRaw('DATE(created_at) as data, SUM(valor) as total')
            ->groupBy('data')
            ->get();

        $labelsGrafico = [];
        $dadosSemanaAtual = [];
        $dadosSemanaAnterior = [];

        for ($i = 6; $i >= 0; $i--) {
            $dataAtual = Carbon::now()->subDays($i)->format('Y-m-d');
            $dataAnterior = Carbon::now()->subDays($i + 7)->format('Y-m-d');
            $diaSemana = Carbon::now()->subDays($i)->locale('pt_BR')->shortDayName;
            
            $vendaAtual = $vendasSemanaAtual->firstWhere('data', $dataAtual);
            $vendaAnterior = $vendasSemanaAnterior->firstWhere('data', $dataAnterior);
            
            $labelsGrafico[] = ucfirst($diaSemana);
            $dadosSemanaAtual[] = $vendaAtual ? $vendaAtual->total : 0;
            $dadosSemanaAnterior[] = $vendaAnterior ? $vendaAnterior->total : 0;
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
            'dadosSemanaAtual',
            'dadosSemanaAnterior'
        ));
    }
}