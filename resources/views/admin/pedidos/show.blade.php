@extends('layouts.admin')

@section('breadcrumb', __('messages.admin_orders') . ' > ' . __('messages.details'))

@section('content')
<div class="details-header">
    <a href="/admin/pedidos" class="back-link">
        <span class="material-symbols-outlined">arrow_back</span>
        {{ __('messages.back_to_orders') }}
    </a>
    
    <span class="status-badge status-{{ strtolower($pedido->status) }}" style="font-size: 14px; padding: 6px 12px;">
        {{ __('messages.status_' . strtolower($pedido->status)) }}
    </span>
</div>

<div class="details-grid">
    <div class="details-main">
        <div class="details-card">
            <h3 class="details-card-title">{{ __('messages.order_items') }}</h3>
            <ul class="item-list">
                @foreach($pedido->itens as $item)
                    <li class="item-row">
                        <div class="item-info">
                            <p class="item-name">{{ $item->produto->nome ?? __('messages.deleted_product') }}</p>
                            <p class="item-meta">{{ __('messages.quantity') }}: {{ $item->quantidade }}x | {{ __('messages.unit_price') }}: R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}</p>
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
            <h3 class="details-card-title">{{ __('messages.order_summary') }}</h3>
            <div class="info-row">
                <span class="info-label">{{ __('messages.code_label') }}</span>
                <span class="info-value">#{{ $pedido->codigo }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('messages.purchase_date_label') }}</span>
                <span class="info-value">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('messages.payment_label') }}</span>
                <span class="info-value" style="text-transform: uppercase;">{{ $pedido->forma_pagamento }}</span>
            </div>
            
            <div class="total-row">
                <span>{{ __('messages.total_label') }}</span>
                <span>R$ {{ number_format($pedido->total, 2, ',', '.') }}</span>
            </div>
        </div>

        <div class="details-card">
            <h3 class="details-card-title">{{ __('messages.customer_data') }}</h3>
            <div class="info-row">
                <span class="info-label">{{ __('messages.name_label') }}</span>
                <span class="info-value">{{ $pedido->cliente_nome }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('messages.email_label') }}</span>
                <span class="info-value">{{ $pedido->cliente_email }}</span>
            </div>
        </div>
    </div>
</div>
@endsection