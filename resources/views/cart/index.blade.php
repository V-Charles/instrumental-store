@extends('layouts.app')

@section('content')

@php
    $cartItems = session('cart', []);
    $cartTotal = 0;
@endphp

<div class="cart-page">

    <section class="cart-hero">
        <img src="{{ asset('images/banner-produtos.jpg') }}" alt="Carrinho de compra">

        <div class="cart-hero-content">
            <h1>Carrinho de compra</h1>
        </div>
    </section>

    <section class="cart-content">

        <div class="cart-table-area">

            <div class="cart-table-header">
                <span>Produto</span>
                <span>Preço</span>
                <span>Quantidade</span>
                <span>Subtotal</span>
                <span></span>
            </div>

            @if (count($cartItems) > 0)

                @foreach ($cartItems as $item)

                    @php
                        $itemName = $item['nome'] ?? 'Produto';
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
                            <button type="button">-</button>
                            <span>{{ $itemQuantity }}</span>
                            <button type="button">+</button>
                        </div>

                        <p class="cart-subtotal">
                            R$ {{ number_format($itemSubtotal, 2, ',', '.') }}
                        </p>

                        <button type="button" class="cart-remove">
                            <span class="material-symbols-outlined">delete</span>
                        </button>

                    </div>

                @endforeach

            @else

                <div class="cart-empty">
                    <p>Seu carrinho está vazio.</p>

                    <a href="{{ route('products.index') }}">
                        Ver produtos
                    </a>
                </div>

            @endif

        </div>

        <aside class="cart-summary">

            <h2>Total</h2>

            <div class="cart-summary-line">
                <span>Subtotal</span>
                <strong>
                    R$ {{ number_format($cartTotal, 2, ',', '.') }}
                </strong>
            </div>

            <div class="cart-summary-line">
                <span>Total</span>
                <strong>
                    R$ {{ number_format($cartTotal, 2, ',', '.') }}
                </strong>
            </div>

            <a href="/dados-compra" class="cart-checkout">
                Finalizar
            </a>

        </aside>

    </section>

    <section class="cart-coupon">

        <h3>Cupom</h3>

        <form action="#" method="POST">
            @csrf

            <input type="text" name="coupon" placeholder="Digite o cupom">

            <button type="submit">
                Aplicar
            </button>
        </form>

    </section>

</div>

@endsection