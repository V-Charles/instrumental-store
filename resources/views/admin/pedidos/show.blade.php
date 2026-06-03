@extends('layouts.admin')

@section('breadcrumb', __('messages.admin_orders') . ' > Detalhes')

@section('content')
<div class="details-header">
    <a href="/admin/pedidos" class="back-link">
        <span class="material-symbols-outlined">arrow_back</span>
        Voltar para Pedidos
    </a>
    
    <span class="status-badge status-{{ strtolower($pedido->status) }}" style="font-size: 14px; padding: 6px 12px;">
        {{ ucfirst($pedido->status) }}
    </span>
</div>

<div class="details-grid">
    <div class="details-main">
        <div class="details-card">
            <h3 class="details-card-title">Itens do Pedido</h3>
            <ul class="item-list">
                @foreach($pedido->itens as $item)
                    <li class="item-row">
                        <div class="item-info">
                            <p class="item-name">{{ $item->produto->nome ?? 'Produto Excluído' }}</p>
                            <p class="item-meta">Quantidade: {{ $item->quantidade }}x | Preço Unitário: R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</p>
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
            <h3 class="details-card-title">Resumo do Pedido</h3>
            <div class="info-row">
                <span class="info-label">Código:</span>
                <span class="info-value">#{{ $pedido->codigo }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Data da Compra:</span>
                <span class="info-value">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Pagamento:</span>
                <span class="info-value" style="text-transform: uppercase;">{{ $pedido->forma_pagamento }}</span>
            </div>
            
            <div class="total-row">
                <span>Total</span>
                <span>R$ {{ number_format($pedido->total, 2, ',', '.') }}</span>
            </div>
        </div>

        <div class="details-card">
            <h3 class="details-card-title">Dados do Cliente</h3>
            <div class="info-row">
                <span class="info-label">Nome:</span>
                <span class="info-value">{{ $pedido->cliente_nome }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">E-mail:</span>
                <span class="info-value">{{ $pedido->cliente_email }}</span>
            </div>
        </div>
    </div>
</div>
@endsection