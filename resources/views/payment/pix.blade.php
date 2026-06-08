@extends('layouts.app')

@section('content')

@php
    $cartItems = session('cart', []);
    $cartTotal = 0;

    foreach ($cartItems as $item) {
        $itemPrice = $item['preco'] ?? 0;
        $itemQuantity = $item['quantidade'] ?? 1;

        $cartTotal += $itemPrice * $itemQuantity;
    }
@endphp

<div class="pix-page">

    <section class="pix-hero">
        <img src="{{ asset('images/banner-produtos.jpg') }}" alt="{{ __('messages.pix_payment') }}">

        <div class="pix-hero-content">
            <h1>{{ __('messages.pix_payment') }}</h1>
        </div>
    </section>

    <section class="pix-content">

        <div class="pix-box">

            <h2>{{ __('messages.pay_with_pix') }}</h2>

            <p class="pix-instruction">
                {{ __('messages.pix_instruction') }}
            </p>

            <div class="pix-qr-code">
                <span class="material-symbols-outlined">
                    qr_code_2
                </span>
            </div>

            <div class="pix-copy-area">
                <label for="pixCode">
                    {{ __('messages.pix_code') }}
                </label>

                <div class="pix-copy-row">
                    <input
                        type="text"
                        id="pixCode"
                        value="00020126580014BR.GOV.BCB.PIX0136instrumental-store-pix-exemplo520400005303986540{{ number_format($cartTotal, 2, '', '') }}5802BR5920Instrumental Store6009Sao Paulo62070503***6304ABCD"
                        readonly>

                    <button type="button" id="copyPixButton">
                        {{ __('messages.copy') }}
                    </button>
                </div>

                <p id="pixCopyMessage" class="pix-copy-message">
                    {{ __('messages.pix_copied') }}
                </p>
            </div>

            <div class="pix-total">
                <span>{{ __('messages.total') }}</span>

                <strong>
                    R$ {{ number_format($cartTotal, 2, ',', '.') }}
                </strong>
            </div>

            <div class="pix-actions">
                <a href="{{ route('payment.index') }}" class="pix-back-button">
                    {{ __('messages.back') }}
                </a>

                <a href="{{ route('order.success') }}" class="pix-confirm-button">
                    {{ __('messages.confirm_payment') }}
                </a>
            </div>

        </div>

    </section>

</div>

@endsection