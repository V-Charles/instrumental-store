@extends('layouts.admin')

@section('breadcrumb', __('messages.returns') . ' > ' . __('messages.details'))

@section('content')

@php
    $productPlaceholder = asset('images/placeholder-produto.jpg');

    $imagemProdutoUrl = function ($produto) use ($productPlaceholder) {
        if (!$produto || empty($produto->imagem_principal)) {
            return $productPlaceholder;
        }

        if (\Illuminate\Support\Str::startsWith($produto->imagem_principal, ['http://', 'https://'])) {
            return $produto->imagem_principal;
        }

        return asset('storage/' . $produto->imagem_principal);
    };
@endphp

<div class="details-header">
    <a href="/admin/devolucoes" class="back-link">
        <span class="material-symbols-outlined">arrow_back</span>
        {{ __('messages.back_to_returns') }}
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
    @endphp

    <span class="status-badge status-{{ $statusClasse }}" style="font-size: 14px; padding: 6px 12px;">
        {{ __('messages.current_status') }}: {{ __('messages.return_status_' . ($devolucao->status ?? 'solicitado')) }}
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
            <h3 class="details-card-title">{{ __('messages.return_information') }}</h3>
            
            <div class="info-row">
                <span class="info-label">{{ __('messages.selected_reason') }}</span>
                <span class="info-value" style="color: #b0003a;">{{ $devolucao->motivo }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('messages.tracking_code_label') }}</span>
                <span class="info-value">{{ $devolucao->codigo_rastreio ?? __('messages.not_posted_yet') }}</span>
            </div>
            
            <div style="margin-top: 20px;">
                <span class="info-label" style="display: block; margin-bottom: 8px;">{{ __('messages.customer_notes') }}</span>
                <div style="background-color: #f9f9f9; padding: 16px; border-radius: 6px; border: 1px solid #eaeaea; font-size: 14px; color: #555;">
                    {{ $devolucao->observacoes ?? __('messages.no_notes_provided') }}
                </div>
            </div>
        </div>

        <div class="details-card">
            <h3 class="details-card-title">{{ __('messages.original_order_items', ['code' => $devolucao->pedido->codigo]) }}</h3>
            <ul class="item-list">
                @foreach($devolucao->pedido->itens as $item)
                    <li class="item-row">
                        <div class="item-info" style="display: flex; align-items: center; gap: 12px;">
                            <img
                                src="{{ $imagemProdutoUrl($item->produto) }}"
                                alt="{{ $item->produto->nome ?? __('messages.deleted_product') }}"
                                onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';"
                                style="width: 54px; height: 54px; object-fit: cover; border-radius: 6px; background: #f4f0ec;"
                            >

                            <div>
                                <p class="item-name">{{ $item->produto->nome ?? __('messages.deleted_product') }}</p>
                                <p class="item-meta">{{ __('messages.quantity') }}: {{ $item->quantidade }}x</p>
                            </div>
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
            <h3 class="details-card-title">{{ __('messages.actions_required') }}</h3>
            <p style="font-size: 13px; color: #666; margin-bottom: 16px; margin-top: 0;">
                {{ __('messages.update_return_notice') }}
            </p>
            
            <div class="action-panel">
                @if($devolucao->status == 'solicitado')
                    <form action="/admin/devolucoes/{{ $devolucao->id }}/status" method="POST" style="margin-bottom: 12px;">
                        @csrf
                        <input type="hidden" name="status" value="aguardando_envio">
                        <button type="submit" class="btn-action btn-primary" style="width: 100%;"><span class="material-symbols-outlined">local_shipping</span> {{ __('messages.btn_authorize_shipping') }}</button>
                    </form>
                    <form action="/admin/devolucoes/{{ $devolucao->id }}/status" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="recusado">
                        <button type="submit" class="btn-action btn-danger" style="width: 100%;"><span class="material-symbols-outlined">close</span> {{ __('messages.btn_refuse_request') }}</button>
                    </form>
                @elseif($devolucao->status == 'aguardando_envio')
                    <form action="/admin/devolucoes/{{ $devolucao->id }}/status" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="inspecao">
                        <button type="submit" class="btn-action btn-primary" style="width: 100%;"><span class="material-symbols-outlined">inventory_2</span> {{ __('messages.btn_confirm_receipt') }}</button>
                    </form>
                @elseif($devolucao->status == 'inspecao')
                    <form action="/admin/devolucoes/{{ $devolucao->id }}/status" method="POST" style="margin-bottom: 12px;">
                        @csrf
                        <input type="hidden" name="status" value="reembolsado">
                        <button type="submit" class="btn-action btn-primary" style="width: 100%;"><span class="material-symbols-outlined">payments</span> {{ __('messages.btn_authorize_refund') }}</button>
                    </form>
                    <form action="/admin/devolucoes/{{ $devolucao->id }}/status" method="POST">
                        @csrf
                        <input type="hidden" name="status" value="recusado">
                        <button type="submit" class="btn-action btn-danger" style="width: 100%;"><span class="material-symbols-outlined">block</span> {{ __('messages.btn_reject_inspection') }}</button>
                    </form>
                @else
                    <div style="text-align: center; padding: 12px; background: #fbf5ee; border-radius: 6px; color: #10332d; font-weight: 600;">
                        {{ __('messages.process_completed') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="details-card">
            <h3 class="details-card-title">{{ __('messages.financial_summary') }}</h3>
            <div class="info-row">
                <span class="info-label">{{ __('messages.amount_paid') }}</span>
                <span class="info-value">R$ {{ number_format($devolucao->pedido->total, 2, ',', '.') }}</span>
            </div>
            <div class="total-row" style="margin-top: 10px; padding-top: 10px;">
                <span>{{ __('messages.amount_to_refund') }}</span>
                <span>R$ {{ number_format($devolucao->valor_reembolso, 2, ',', '.') }}</span>
            </div>
        </div>
        
        <div class="details-card">
            <h3 class="details-card-title">{{ __('messages.customer_data') }}</h3>
            <div class="info-row">
                <span class="info-label">{{ __('messages.name_label') }}</span>
                <span class="info-value">{{ $devolucao->pedido->cliente_nome }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">{{ __('messages.email_label') }}</span>
                <span class="info-value">{{ $devolucao->pedido->cliente_email }}</span>
            </div>
        </div>
    </div>
</div>
@endsection