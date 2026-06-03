<?php

namespace App\Http\Controllers;

use App\Models\Pagamento;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PagamentoController extends Controller
{
    public function index(Request $request)
    {
        $query = Pagamento::with('pedido');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('pedido', function ($q) use ($search) {
                $q->where('codigo', 'like', "%{$search}%")
                  ->orWhere('cliente_nome', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pagamentos = $query->latest()->get();

        $seteDiasAtras = Carbon::now()->subDays(7);
        
        $receitaTotal = Pagamento::where('status', 'aprovado')->where('created_at', '>=', $seteDiasAtras)->sum('valor');
        $transacoesConcluidas = Pagamento::where('status', 'aprovado')->where('created_at', '>=', $seteDiasAtras)->count();
        $transacoesPendentes = Pagamento::where('status', 'pendente')->where('created_at', '>=', $seteDiasAtras)->count();
        $transacoesFalha = Pagamento::where('status', 'recusado')->where('created_at', '>=', $seteDiasAtras)->count();
        $totalPagamentos = Pagamento::count();

        if ($request->wantsJson()) {
            $pagamentos->transform(function($pagamento) {
                $pagamento->data_formatada = $pagamento->created_at->format('d/m/Y');
                $pagamento->valor_formatado = number_format($pagamento->valor, 2, ',', '.');
                $pagamento->metodo_texto = ucfirst($pagamento->metodo);
                $pagamento->cliente_codigo = $pagamento->pedido->codigo ?? 'N/A';
                $pagamento->cliente_nome = $pagamento->pedido->cliente_nome ?? 'Desconhecido';

                if ($pagamento->status === 'aprovado') {
                    $pagamento->status_classe = 'entregue';
                    $pagamento->status_texto = 'Finalizado';
                } elseif ($pagamento->status === 'recusado') {
                    $pagamento->status_classe = 'cancelado';
                    $pagamento->status_texto = 'Cancelado';
                } else {
                    $pagamento->status_classe = 'pendente';
                    $pagamento->status_texto = 'Pendente';
                }

                return $pagamento;
            });
            return response()->json($pagamentos);
        }

        return view('admin.pagamentos.index', compact(
            'pagamentos',
            'receitaTotal',
            'transacoesConcluidas',
            'transacoesPendentes',
            'transacoesFalha',
            'totalPagamentos'
        ));
    }
}