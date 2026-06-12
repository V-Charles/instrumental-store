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
        <span>{{ __('messages.cards') }}</span>
        <span class="client-separator">></span>
        <span>{{ __('messages.edit_card') }}</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-profile-page">

                <h2>{{ __('messages.edit_card') }}</h2>

                @if ($errors->any())
                    <div class="error-message">
                        <p>Verifique os campos preenchidos.</p>
                    </div>
                @endif

                @php
                    $numero = $cartao->numero_cartao ?? '';
                    $numeroLimpo = preg_replace('/\D/', '', $numero);

                    if (strlen($numeroLimpo) === 16) {
                        $numeroFormatado = substr($numeroLimpo, 0, 4) . ' ' .
                                           substr($numeroLimpo, 4, 4) . ' ' .
                                           substr($numeroLimpo, 8, 4) . ' ' .
                                           substr($numeroLimpo, 12, 4);
                    } else {
                        $numeroFormatado = $numero;
                    }
                @endphp

                <form 
                    action="{{ route('cliente.cartoes.update', $cartao->id) }}" 
                    method="POST" 
                    class="client-profile-form"
                >
                    @csrf
                    @method('PUT')

                    <div class="client-form-grid client-form-grid-three">

                        <div class="client-form-group">
                            <label>{{ __('messages.card_nickname') }}</label>
                            <input 
                                type="text" 
                                name="apelido_cartao" 
                                value="{{ old('apelido_cartao', $cartao->apelido_cartao ?? '') }}"
                            >

                            @error('apelido_cartao')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.card_type') }}</label>

                            <select name="tipo_cartao">
                                <option value="">{{ __('messages.select_option') }}</option>

                                <option 
                                    value="credito"
                                    {{ old('tipo_cartao', $cartao->tipo_cartao ?? '') === 'credito' ? 'selected' : '' }}>
                                    {{ __('messages.credit_card') }}
                                </option>

                                <option 
                                    value="debito"
                                    {{ old('tipo_cartao', $cartao->tipo_cartao ?? '') === 'debito' ? 'selected' : '' }}>
                                    {{ __('messages.debit_card') }}
                                </option>
                            </select>

                            @error('tipo_cartao')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.card_holder_name') }}</label>
                            <input 
                                type="text" 
                                name="nome_impresso" 
                                value="{{ old('nome_impresso', $cartao->nome_impresso ?? '') }}"
                            >

                            @error('nome_impresso')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.card_number') }}</label>
                            <input 
                                type="text" 
                                name="numero_cartao" 
                                value="{{ old('numero_cartao', $numeroFormatado) }}"
                                placeholder="0000 0000 0000 0000"
                            >

                            @error('numero_cartao')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.expiration_date') }}</label>
                            <input 
                                type="text" 
                                name="validade" 
                                value="{{ old('validade', $cartao->validade ?? '') }}"
                                placeholder="MM/AA"
                            >

                            @error('validade')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.security_code') }}</label>
                            <input 
                                type="text" 
                                name="codigo_seguranca" 
                                value="{{ old('codigo_seguranca', $cartao->codigo_seguranca ?? '') }}"
                                placeholder="000"
                            >

                            @error('codigo_seguranca')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="client-profile-actions">

                        <a href="{{ route('cliente.cartoes') }}" class="client-btn client-btn-secondary client-btn-link">
                            {{ __('messages.back_to_cards') }}
                        </a>

                        <button type="submit" class="client-btn client-btn-primary">
                            {{ __('messages.save') }}
                        </button>

                    </div>

                </form>

            </section>

        </main>

    </div>

</div>

@endsection