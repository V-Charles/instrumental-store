@extends('layouts.app')

@section('content')

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

            <div class="pix-qr-code" style="display: flex; justify-content: center; align-items: center; padding: 20px;">
                @if(!empty($pedido->pix_qr_code_base64))
                    <img src="data:image/png;base64,{{ $pedido->pix_qr_code_base64 }}" alt="QR Code Pix" style="max-width: 250px; height: auto;">
                @else
                    <span class="material-symbols-outlined" style="font-size: 100px;">qr_code_2</span>
                @endif
            </div>

            <div class="pix-copy-area">
                <label for="pixCode">
                    {{ __('messages.pix_code') }}
                </label>

                <div class="pix-copy-row">

                    <input
                        type="text"
                        id="pixCode"
                        value="{{ $pedido->pix_copia_cola }}"
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
                    R$ {{ number_format($pedido->total, 2, ',', '.') }}
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