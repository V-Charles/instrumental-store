<?php

namespace App\Http\Controllers;

use App\Models\Devolucao;
use Illuminate\Http\Request;

class DevolucaoController extends Controller
{
    public function index(Request $request)
    {
        $query = Devolucao::with('pedido');

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

        $devolucoes = $query->latest()->get();

        $totalDevolucoes = Devolucao::count();
        $novasDevolucoes = Devolucao::where('status', 'solicitado')->count();
        $emInspecao = Devolucao::where('status', 'inspecao')->count();
        $reembolsadas = Devolucao::where('status', 'reembolsado')->count();

        if ($request->wantsJson()) {
            $devolucoes->transform(function($devolucao) {
                $devolucao->data_formatada = $devolucao->created_at->format('d/m/Y');
                $devolucao->valor_formatado = number_format($devolucao->valor_reembolso, 2, ',', '.');
                $devolucao->codigo_pedido = $devolucao->pedido->codigo ?? 'N/A';
                $devolucao->cliente_nome = $devolucao->pedido->cliente_nome ?? 'Desconhecido';
                
                $devolucao->status_texto = match($devolucao->status) {
                    'solicitado' => 'Solicitado',
                    'aguardando_envio' => 'Aguardando Envio',
                    'inspecao' => 'Em Inspeção',
                    'reembolsado' => 'Reembolsado',
                    'recusado' => 'Recusado',
                    default => ucfirst($devolucao->status)
                };

                $devolucao->status_classe = match($devolucao->status) {
                    'solicitado' => 'pendente',
                    'aguardando_envio' => 'enviado',
                    'inspecao' => 'default',
                    'reembolsado' => 'entregue',
                    'recusado' => 'cancelado',
                    default => 'default'
                };

                return $devolucao;
            });
            return response()->json($devolucoes);
        }

        return view('admin.devolucoes.index', compact(
            'devolucoes',
            'totalDevolucoes',
            'novasDevolucoes',
            'emInspecao',
            'reembolsadas'
        ));
    }

    public function show($id)
    {
        $devolucao = Devolucao::with(['pedido.itens.produto'])->findOrFail($id);
        
        return view('admin.devolucoes.show', compact('devolucao'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:solicitado,aguardando_envio,inspecao,reembolsado,recusado'
        ]);

        $devolucao = Devolucao::findOrFail($id);
        
        $devolucao->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status da devolução atualizado com sucesso!');
    }
}