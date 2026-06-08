@extends('layouts.app')

@section('content')

@php
    $cartItems = session('cart', []);
    $cartTotal = 0;

    $cartoesCadastrados = $cartoesCadastrados ?? [];
    $enderecosCadastrados = $enderecosCadastrados ?? [];
@endphp

<div class="payment-page">

    <section class="payment-hero">
        <img src="{{ asset('images/banner-produtos.jpg') }}" alt="{{ __('messages.payment_form') }}">

        <div class="payment-hero-content">
            <h1>{{ __('messages.payment_form') }}</h1>
        </div>
    </section>

    <section class="payment-content">

        <div class="payment-form-area">

            <h2>{{ __('messages.purchase_data') }}</h2>

            <form action="#" method="POST" class="payment-form">
                @csrf

                <div class="payment-form-group">
                    <label for="payment_method">
                        {{ __('messages.payment_method') }}
                    </label>

                    <select id="payment_method" name="payment_method">
                        <option value="">
                            {{ __('messages.select') }}
                        </option>

                        <option value="credito">
                            {{ __('messages.credit_card') }}
                        </option>

                        <option value="debito">
                            {{ __('messages.debit_card') }}
                        </option>

                        <option value="pix">
                            {{ __('messages.pix') }}
                        </option>
                    </select>
                </div>

                <div class="payment-row">

                    <div class="payment-form-group">
                        <label for="registered_card">
                            {{ __('messages.registered_cards') }}
                        </label>

                        <select id="registered_card" name="registered_card">
                            <option value="">
                                {{ __('messages.select_registered_card') }}
                            </option>

                            @forelse ($cartoesCadastrados as $cartao)

                                <option value="{{ $cartao->id }}">
                                    {{ $cartao->apelido ?? __('messages.credit_card') }}

                                    @if (!empty($cartao->final))
                                        - final {{ $cartao->final }}
                                    @endif
                                </option>

                            @empty

                                <option value="" disabled>
                                    {{ __('messages.no_registered_cards') }}
                                </option>

                            @endforelse
                        </select>
                    </div>

                    <button type="button" class="payment-secondary-button">
                        {{ __('messages.register_payment_method') }}
                    </button>

                </div>

                <div class="payment-row">

                    <div class="payment-form-group">
                        <label for="delivery_address">
                            {{ __('messages.registered_address') }}
                        </label>

                        <select id="delivery_address" name="delivery_address">
                            <option value="">
                                {{ __('messages.select_registered_address') }}
                            </option>

                            @forelse ($enderecosCadastrados as $endereco)

                                <option value="{{ $endereco->id }}">
                                    {{ $endereco->rua ?? __('messages.registered_address') }}

                                    @if (!empty($endereco->numero))
                                        , {{ $endereco->numero }}
                                    @endif

                                    @if (!empty($endereco->cidade))
                                        - {{ $endereco->cidade }}
                                    @endif
                                </option>

                            @empty

                                <option value="" disabled>
                                    {{ __('messages.no_registered_address') }}
                                </option>

                            @endforelse
                        </select>
                    </div>

                    <button type="button" class="payment-secondary-button">
                        {{ __('messages.register_address') }}
                    </button>

                </div>

            </form>

        </div>

        <aside class="payment-summary">

            <div class="payment-summary-table">

                <div class="payment-summary-header">
                    <span>{{ __('messages.product') }}</span>
                    <span>{{ __('messages.subtotal') }}</span>
                </div>

                @if (count($cartItems) > 0)

                    @foreach ($cartItems as $item)

                        @php
                            $itemName = $item['nome'] ?? __('messages.product');
                            $itemPrice = $item['preco'] ?? 0;
                            $itemQuantity = $item['quantidade'] ?? 1;
                            $itemSubtotal = $itemPrice * $itemQuantity;

                            $cartTotal += $itemSubtotal;
                        @endphp

                        <div class="payment-summary-row">
                            <span>
                                {{ $itemName }} x {{ $itemQuantity }}
                            </span>

                            <strong>
                                R$ {{ number_format($itemSubtotal, 2, ',', '.') }}
                            </strong>
                        </div>

                    @endforeach

                @else

                    <div class="payment-summary-row">
                        <span>{{ __('messages.no_products_in_cart') }}</span>
                        <strong>R$ 0,00</strong>
                    </div>

                @endif

                <div class="payment-summary-total">
                    <span>{{ __('messages.total') }}</span>

                    <strong>
                        R$ {{ number_format($cartTotal, 2, ',', '.') }}
                    </strong>
                </div>

            </div>

<a href="{{ route('order.success') }}" class="payment-finish-button" id="paymentFinishButton">
    {{ __('messages.finish') }}
</a>

        </aside>

    </section>

    <div class="payment-back">
    <a href="{{ route('cart') }}">
        {{ __('messages.back') }}
    </a>
</div>

</div>

@endsection