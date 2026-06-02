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

                <form class="client-profile-form">

                    <div class="client-form-grid">

                        <div class="client-form-group">
                            <label>{{ __('messages.card_nickname') }}</label>
                            <input 
                                type="text" 
                                name="apelido_cartao" 
                                value="{{ $cartao->apelido_cartao ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.card_type') }}</label>

                            <select name="tipo_cartao">
                                <option value="">
                                    {{ __('messages.select_option') }}
                                </option>

                                <option 
                                    value="credito"
                                    {{ ($cartao->tipo_cartao ?? '') === 'credito' ? 'selected' : '' }}>
                                    {{ __('messages.credit_card') }}
                                </option>

                                <option 
                                    value="debito"
                                    {{ ($cartao->tipo_cartao ?? '') === 'debito' ? 'selected' : '' }}>
                                    {{ __('messages.debit_card') }}
                                </option>
                            </select>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.card_holder_name') }}</label>
                            <input 
                                type="text" 
                                name="nome_impresso" 
                                value="{{ $cartao->nome_impresso ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.card_number') }}</label>
                            <input 
                                type="text" 
                                name="numero_cartao" 
                                value="{{ $cartao->numero_cartao ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.expiration_date') }}</label>
                            <input 
                                type="text" 
                                name="validade" 
                                value="{{ $cartao->validade ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.security_code') }}</label>
                            <input 
                                type="text" 
                                name="codigo_seguranca" 
                                value="{{ $cartao->codigo_seguranca ?? '' }}">
                        </div>

                    </div>

                    <div class="client-profile-actions">

                        <a href="/cliente/cartoes" class="client-btn client-btn-secondary client-btn-link">
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