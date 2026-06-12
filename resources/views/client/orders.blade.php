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
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-orders-page">

                <h2>{{ __('messages.my_orders') }}</h2>

                @if (session('success'))
                    <p class="success-message">
                        {{ session('success') }}
                    </p>
                @endif

                <div class="client-orders-list">

                    @isset($pedidos)

                        @forelse ($pedidos as $pedido)

                            @php
                                $statusPedido = strtolower($pedido->status ?? 'andamento');

                                $pedidoCancelado = $statusPedido === 'cancelado';
                                $pedidoFinalizado = $statusPedido === 'finalizado';

                                /*
                                    Como ainda não temos uma coluna separada para etapa,
                                    vamos usar o próprio status para controlar a barra.
                                */
                                $etapaPedido = strtolower($pedido->status ?? 'confirmado');

                                $confirmadoAtivo = true;

                                $preparoAtivo = !$pedidoCancelado && in_array($etapaPedido, [
                                    'preparo',
                                    'envio',
                                    'entregue',
                                    'finalizado'
                                ]);

                                $envioAtivo = !$pedidoCancelado && in_array($etapaPedido, [
                                    'envio',
                                    'entregue',
                                    'finalizado'
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

                                $pedidoId = $pedido->id;
                            @endphp

                            <article class="client-order-card">

                                <div class="client-order-product">

                                    <img 
                                        src="{{ $imagemProdutoUrl($produto) }}" 
                                        alt="{{ $nomeProduto }}"
                                        onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';"
                                    >

                                    <div>
                                        <h3>{{ $nomeProduto }}</h3>

                                        @if ($marcaProduto)
                                            <p>{{ $marcaProduto }}</p>
                                        @endif

                                        @if (!empty($pedido->codigo))
                                            <p>
                                                Código: {{ $pedido->codigo }}
                                            </p>
                                        @endif

                                        @if (!empty($pedido->total))
                                            <p>
                                                Total: R$ {{ number_format($pedido->total, 2, ',', '.') }}
                                            </p>
                                        @endif
                                    </div>

                                </div>

                                <div class="client-order-progress">

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

                                <div class="client-order-status">

                                    @if ($pedidoCancelado)

                                        <span class="client-status client-status-canceled">
                                            {{ __('messages.order_canceled') }}
                                        </span>

                                    @elseif ($pedidoFinalizado)

                                        <div class="client-order-status-actions">

                                            <span class="client-status-text client-status-finished-text">
                                                {{ __('messages.order_finished') }}
                                            </span>

                                            <a 
                                                href="{{ route('cliente.pedidos.detalhe', $pedidoId) }}" 
                                                class="client-status client-status-progress"
                                            >
                                                {{ __('messages.view') }}
                                            </a>

                                        </div>

                                    @else

                                        <div class="client-order-status-actions">

                                            <a 
                                                href="{{ route('cliente.pedidos.detalhe', $pedidoId) }}" 
                                                class="client-status client-status-progress"
                                            >
                                                {{ __('messages.order_in_progress') }}
                                            </a>

                                            <button type="button" class="client-status client-status-cancel-action">
                                                {{ __('messages.cancel_order') }}
                                            </button>

                                        </div>

                                    @endif

                                </div>

                            </article>

                        @empty

                            <p class="client-empty-message">
                                {{ __('messages.no_orders') }}
                            </p>

                        @endforelse

                    @else

                        <p class="client-empty-message">
                            {{ __('messages.orders_backend_message') }}
                        </p>

                    @endisset

                </div>

            </section>

        </main>

    </div>

</div>

@endsection