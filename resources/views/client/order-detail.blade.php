@extends('layouts.app')

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

<div class="client-page">

    <input type="checkbox" id="client-menu-toggle">

    <div class="client-breadcrumb-bar">
        <label for="client-menu-toggle" class="client-menu-button">
            <span class="material-symbols-outlined">menu</span>
        </label>

        <span>{{ __('messages.home') }}</span>
        <span class="client-separator">></span>
        <span>{{ __('messages.orders') }}</span>
        <span class="client-separator">></span>
        <span>{{ __('messages.order_details') }}</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-order-detail-page">

                <h2>{{ __('messages.order_details') }}</h2>

                @isset($pedido)

                    @php
                        /*
                            Informações esperadas do backend:

                            $pedido->status:
                            - andamento
                            - finalizado
                            - cancelado

                            $pedido->etapa:
                            - confirmado
                            - preparo
                            - envio
                            - entregue

                            $pedido->data_compra
                            $pedido->produto->nome
                            $pedido->produto->marca
                            $pedido->produto->preco
                            $pedido->produto->imagem_principal
                        */

                        $statusPedido = strtolower($pedido->status ?? 'andamento');
                        $etapaPedido = strtolower($pedido->status ?? 'confirmado');

                        $pedidoCancelado = $statusPedido === 'cancelado';
                        $pedidoFinalizado = $statusPedido === 'finalizado';

                        $confirmadoAtivo = true;

                        $preparoAtivo = !$pedidoCancelado && in_array($etapaPedido, [
                            'preparo',
                            'envio',
                            'entregue'
                        ]);

                        $envioAtivo = !$pedidoCancelado && in_array($etapaPedido, [
                            'envio',
                            'entregue'
                        ]);

                        $entregueAtivo = !$pedidoCancelado && (
                            $pedidoFinalizado || $etapaPedido === 'entregue'
                        );

                        $preparoPendente = !$pedidoCancelado && !$preparoAtivo;
                        $envioPendente = !$pedidoCancelado && !$envioAtivo;
                        $entreguePendente = !$pedidoCancelado && !$entregueAtivo;

                        $item = $pedido->itens->first();
                        $produto = $item?->produto;

                        $nomeProduto = $produto->nome ?? __('messages.product');
                        $marcaProduto = $produto->marca ?? '';
                        $precoProduto = $produto->preco ?? null;
                        $dataCompra = $pedido->data_compra ?? null;
                    @endphp

                    <div class="client-order-detail-content">

                        <div class="client-order-detail-image">
                            <img 
                                src="{{ $imagemProdutoUrl($produto) }}" 
                                alt="{{ $nomeProduto }}"
                                onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';">
                        </div>

                        <div class="client-order-detail-info">

                            <h3>{{ $nomeProduto }}</h3>

                            @if ($marcaProduto)
                                <p class="client-order-detail-brand">
                                    {{ $marcaProduto }}
                                </p>
                            @endif

                            @if ($precoProduto)
                                <p class="client-order-detail-price">
                                    R$ {{ number_format($precoProduto, 2, ',', '.') }}
                                </p>
                            @endif

                            @if ($dataCompra)
                                <p class="client-order-detail-date">
                                    {{ __('messages.purchase_date') }}: {{ $dataCompra }}
                                </p>
                            @endif

                            <div class="client-order-progress client-order-detail-progress">

                                <div class="client-order-step {{ $confirmadoAtivo ? 'active' : '' }}">
                                    <span></span>
                                    <p>{{ __('messages.order_confirmed') }}</p>
                                </div>

                                <div class="client-order-line {{ $preparoAtivo ? 'active' : ($preparoPendente ? 'pending' : '') }}"></div>

                                <div class="client-order-step {{ $preparoAtivo ? 'active' : ($preparoPendente ? 'pending' : '') }}">
                                    <span></span>
                                    <p>{{ __('messages.order_preparing') }}</p>
                                </div>

                                <div class="client-order-line {{ $envioAtivo ? 'active' : ($envioPendente ? 'pending' : '') }}"></div>

                                <div class="client-order-step {{ $envioAtivo ? 'active' : ($envioPendente ? 'pending' : '') }}">
                                    <span></span>
                                    <p>{{ __('messages.order_shipping') }}</p>
                                </div>

                                <div class="client-order-line {{ $entregueAtivo ? 'active' : ($entreguePendente ? 'pending' : '') }}"></div>

                                <div class="client-order-step {{ $entregueAtivo ? 'active' : ($entreguePendente ? 'pending' : '') }}">
                                    <span></span>
                                    <p>{{ __('messages.order_delivered') }}</p>
                                </div>

                            </div>

                            <div style="margin-top:20px;">

                                <p>
                                    <strong>Código:</strong>
                                    {{ $pedido->codigo }}
                                </p>

                                <p>
                                    <strong>Total:</strong>
                                    R$ {{ number_format($pedido->total, 2, ',', '.') }}
                                </p>

                            </div>

                            <div class="client-order-detail-status">

                                @if ($pedidoCancelado)
                                    <span class="client-status-text client-status-canceled-text">
                                        {{ __('messages.order_canceled') }}
                                    </span>
                                @elseif ($pedidoFinalizado)
                                    <span class="client-status-text client-status-finished-text">
                                        {{ __('messages.order_finished') }}
                                    </span>
                                @else
                                    <span class="client-status-text client-status-progress-text">
                                        {{ __('messages.order_in_progress') }}
                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>

                    <h3>Itens do Pedido</h3>

                    @foreach($pedido->itens as $item)

                        <div style="margin-bottom:15px;">

                            <strong>
                                {{ $item->produto->nome }}
                            </strong>

                            <br>
                            Quantidade:
                            {{ $item->quantidade }}
                            <br>

                            Preço Unitário:
                            R$ {{ number_format($item->preco_unitario, 2, ',', '.') }}

                        </div>

                    @endforeach
                
                    <div class="client-order-detail-actions">

                        <a href="/cliente/pedidos" class="client-btn client-btn-secondary client-btn-link">
                            {{ __('messages.back_to_orders') }}
                        </a>

                        @if (!$pedidoFinalizado && !$pedidoCancelado)
                            <button type="button" class="client-btn client-btn-primary">
                                {{ __('messages.cancel_order') }}
                            </button>
                        @endif

                    </div>

                @else

                    <p class="client-empty-message">
                        {{ __('messages.order_details_backend_message') }}
                    </p>

                    <div class="client-order-detail-actions">
                        <a href="/cliente/pedidos" class="client-btn client-btn-secondary client-btn-link">
                            {{ __('messages.back_to_orders') }}
                        </a>
                    </div>

                @endisset

            </section>

        </main>

    </div>

</div>

@endsection