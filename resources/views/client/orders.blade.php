@extends('layouts.app')

@section('content')

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

                <div class="client-orders-list">

                    @isset($pedidos)

                        @forelse ($pedidos as $pedido)

                            @php
                                /*
                                    Status esperados do backend:
                                    - andamento
                                    - finalizado
                                    - cancelado

                                    Etapas esperadas do backend:
                                    - confirmado
                                    - preparo
                                    - envio
                                    - entregue
                                */

                                $statusPedido = strtolower($pedido->status ?? 'andamento');
                                $etapaPedido = strtolower($pedido->etapa ?? 'confirmado');

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

                                $produto = $pedido->produto ?? null;

                                $nomeProduto = $produto->nome ?? __('messages.product');
                                $marcaProduto = $produto->marca ?? '';
                                $imagemProduto = $produto->imagem_principal ?? null;

                                $pedidoId = $pedido->id ?? '';
                            @endphp

                            <article class="client-order-card">

                                <div class="client-order-product">
                                    <img 
                                        src="{{ $imagemProduto ? asset('storage/' . $imagemProduto) : asset('images/placeholder-produto.jpg') }}" 
                                        alt="{{ $nomeProduto }}">

                                    <div>
                                        <h3>{{ $nomeProduto }}</h3>

                                        @if ($marcaProduto)
                                            <p>{{ $marcaProduto }}</p>
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

                                            <a href="/cliente/pedidos/{{ $pedidoId }}" class="client-status client-status-progress">
                                                {{ __('messages.view') }}
                                            </a>
                                        </div>

                                    @else

                                        <div class="client-order-status-actions">
                                            <a href="/cliente/pedidos/{{ $pedidoId }}" class="client-status client-status-progress">
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