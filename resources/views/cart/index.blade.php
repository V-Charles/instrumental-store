@extends('layouts.app')

@section('content')

@php
    $cartItems = $cart ?? session('cart', []);
    $cartTotal = 0;
@endphp

<div class="cart-page">

    <section class="cart-hero">
        <img src="{{ asset('images/banner-produtos.jpg') }}" alt="{{ __('messages.shopping_cart') }}">

        <div class="cart-hero-content">
            <h1>{{ __('messages.shopping_cart') }}</h1>
        </div>
    </section>

    <section class="cart-content">

        <div class="cart-table-area">

            <div class="cart-table-header">
                <span>{{ __('messages.product') }}</span>
                <span>{{ __('messages.price') }}</span>
                <span>{{ __('messages.quantity') }}</span>
                <span>{{ __('messages.subtotal') }}</span>
                <span></span>
            </div>

            @if (count($cartItems) > 0)

                @foreach ($cartItems as $item)

                    @php
                        $itemId = $item['id'] ?? null;
                        $itemName = $item['nome'] ?? __('messages.product');
                        $itemPrice = $item['preco'] ?? 0;
                        $itemQuantity = $item['quantidade'] ?? 1;
                        $itemImage = $item['imagem'] ?? null;
                        $itemSubtotal = $itemPrice * $itemQuantity;

                        $cartTotal += $itemSubtotal;
                    @endphp

                    <div class="cart-table-row">

                        <div class="cart-product-info">

                            @if ($itemImage)
                                <img src="{{ asset('storage/' . $itemImage) }}" alt="{{ $itemName }}">
                            @else
                                <div class="cart-product-placeholder">
                                    IS
                                </div>
                            @endif

                            <p>{{ $itemName }}</p>

                        </div>

                        <p class="cart-price">
                            R$ {{ number_format($itemPrice, 2, ',', '.') }}
                        </p>

                        <div class="cart-quantity">

                            <form action="{{ route('cart.diminuir', $itemId) }}" method="POST">
                                @csrf

                                <button type="submit">
                                    -
                                </button>
                            </form>

                            <span>{{ $itemQuantity }}</span>

                            <form action="{{ route('cart.aumentar', $itemId) }}" method="POST">
                                @csrf

                                <button type="submit">
                                    +
                                </button>
                            </form>

                        </div>

                        <p class="cart-subtotal">
                            R$ {{ number_format($itemSubtotal, 2, ',', '.') }}
                        </p>

                        <form action="{{ route('cart.remover', $itemId) }}" method="POST" class="cart-remove-form">
                            @csrf

                            <button type="submit" class="cart-remove" title="{{ __('messages.remove') }}">
                                <span class="material-symbols-outlined">delete</span>
                            </button>
                        </form>

                    </div>

                @endforeach

            @else

                <div class="cart-empty">
                    <p>{{ __('messages.cart_empty') }}</p>

                    <a href="{{ route('products.index') }}">
                        {{ __('messages.see_products') }}
                    </a>
                </div>

            @endif

        </div>

        <aside class="cart-summary">

            <h2>{{ __('messages.total') }}</h2>

            <div class="cart-summary-line">
                <span>{{ __('messages.subtotal') }}</span>

                <strong>
                    R$ {{ number_format($cartTotal, 2, ',', '.') }}
                </strong>
            </div>

            <div class="cart-summary-line">
                <span>{{ __('messages.total') }}</span>

                <strong>
                    R$ {{ number_format($cartTotal, 2, ',', '.') }}
                </strong>
            </div>

            <a href="{{ route('payment.index') }}" class="cart-checkout">
                {{ __('messages.finish') }}
            </a>

        </aside>

    </section>

    <section class="cart-coupon">

        <h3>{{ __('messages.coupon') }}</h3>

        <form action="#" method="POST">
            @csrf

            <input 
                type="text" 
                name="coupon" 
                placeholder="{{ __('messages.enter_coupon') }}">

            <button type="submit">
                {{ __('messages.apply') }}
            </button>
        </form>

    </section>

</div>

@endsection