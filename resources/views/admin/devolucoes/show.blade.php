@extends('layouts.admin')

@section('breadcrumb', 'Devoluções > Detalhes')

@section('content')
<div class="details-header">
    <a href="/admin/devolucoes" class="back-link">
        <span class="material-symbols-outlined">arrow_back</span>
        Voltar para Devoluções
    </a>
    
    @php
        $statusClasse = match($devolucao->status) {
            'solicitado' => 'pendente',
            'aguardando_envio' => 'enviado',
            'inspecao' => 'default',
            'reembolsado' => 'entregue',
            'recusado' => 'cancelado',
            default => 'default'
        };
        $statusTexto = match($devolucao->status) {
            'solicitado' => 'Solicitado',
            'aguardando_envio' => 'Aguardando Envio',
            'inspecao' => 'Em Inspeção',
            'reembolsado' => 'Reembolsado',
            'recusado' => 'Recusado',
            default => ucfirst($devolucao->status)
        };
    @endphp

    <span class="status-badge status-{{ $statusClasse }}" style="font-size: 14px; padding: 6px 12px;">
        Status Atual: {{ $statusTexto }}
    </span>
</div>

@if(session('success'))
    <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px; font-weight: 600; font-size: 14px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
@endif

<div class="details-grid">
    <div class="details-main">
        <div class="details-card">
            <h3 class="details-card-title">Informações da Devolução</h3>
            
            <div class="info-row">
                <span class="info-label">Motivo selecionado:</span>
                <span class="info-value" style="color: #b0003a;">{{ $devolucao->motivo }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Código de Rastreio (Correios):</span>
                <span class="info-value">{{ $devolucao->codigo_rastreio ?? 'Ainda não postado' }}</span>
            </div>
            
            <div style="margin-top: 20px;">
                <span class="info-label" style="display: block; margin-bottom: 8px;">Observações do Cliente:</span>
                <div style="background-color: #f9f9f9; padding: 16px; border-radius: 6px; border: 1px solid #eaeaea; font-size: 14px; color: #555;">
                    {{ $devolucao->observacoes ?? 'Nenhuma observação adicional fornecida.' }}
                </div>
            </div>
        </div>

        <div class="details-card">
            <h3 class="details-card-title">Itens do Pedido Original (#{{ $devolucao->pedido->codigo }})</h3>
            <ul class="item-list">
                @foreach($devolucao->pedido->itens as $item)
                    <li class="item-row">
                        <div class="item-info">
                            <p class="item-name">{{ $item->produto->nome ?? 'Produto Excluído' }}</p>
                            <p class="item-meta">Quantidade: {{ $item->quantidade }}x</p>
                        </div>
                        <div class="item-price">
                            R$ {{ number_format($item->quantidade * $item->preco_unitario, 2, ',', '.') }}
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="details-sidebar">
        <div class="details-card">
            <h3 class="details-card-title">Ações Necessárias</h3>
            <p style="font-size: 13px; color: #666; margin-bottom: 16px; margin-top: 0;">
                Atualize o andamento desta devolução para notificar o cliente.
            </p>
            
            <div class="action-panel">
                @if($devolucao->status == 'solicitado')
                    <form action="/admin/devolucoes/{{ $devolucao->id }}/status" method="POST" style="margin-bottom: 12px;">
                        @csrf
                        <input type="hidden" name="status" value="aguardando_envio">
                        <button type="submit" class="btn-action btn-primary" style="width: 100%;"><span class="material-symbols-outlined">local_shipping</span> Autorizar Postagem</button>
                    </form>
                    <form action="/admin/devolucoes/{{ $devolucao->id }}/status" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="recusado">
                        <button type="submit" class="btn-action btn-danger" style="width: 100%;"><span class="material-symbols-outlined">close</span> Recusar Solicitação</button>
                    </form>
                @elseif($devolucao->status == 'aguardando_envio')
                    <form action="/admin/devolucoes/{{ $devolucao->id }}/status" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="inspecao">
                        <button type="submit" class="btn-action btn-primary" style="width: 100%;"><span class="material-symbols-outlined">inventory_2</span> Confirmar Recebimento</button>
                    </form>
                @elseif($devolucao->status == 'inspecao')
                    <form action="/admin/devolucoes/{{ $devolucao->id }}/status" method="POST" style="margin-bottom: 12px;">
                        @csrf
                        <input type="hidden" name="status" value="reembolsado">
                        <button type="submit" class="btn-action btn-primary" style="width: 100%;"><span class="material-symbols-outlined">payments</span> Autorizar Estorno</button>
                    </form>
                    <form action="/admin/devolucoes/{{ $devolucao->id }}/status" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="recusado">
                        <button type="submit" class="btn-action btn-danger" style="width: 100%;"><span class="material-symbols-outlined">block</span> Reprovar Inspeção</button>
                    </form>
                @else
                    <div style="text-align: center; padding: 12px; background: #fbf5ee; border-radius: 6px; color: #10332d; font-weight: 600;">
                        Processo Finalizado
                    </div>
                @endif
            </div>
        </div>

        <div class="details-card">
            <h3 class="details-card-title">Resumo Financeiro</h3>
            <div class="info-row">
                <span class="info-label">Valor Pago:</span>
                <span class="info-value">R$ {{ number_format($devolucao->pedido->total, 2, ',', '.') }}</span>
            </div>
            <div class="total-row" style="margin-top: 10px; padding-top: 10px;">
                <span>Valor a Estornar</span>
                <span>R$ {{ number_format($devolucao->valor_reembolso, 2, ',', '.') }}</span>
            </div>
        </div>
        
        <div class="details-card">
            <h3 class="details-card-title">Dados do Cliente</h3>
            <div class="info-row">
                <span class="info-label">Nome:</span>
                <span class="info-value">{{ $devolucao->pedido->cliente_nome }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">E-mail:</span>
                <span class="info-value">{{ $devolucao->pedido->cliente_email }}</span>
            </div>
        </div>
    </div>
</div>
@endsection