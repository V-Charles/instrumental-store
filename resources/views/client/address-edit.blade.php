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
        <span>{{ __('messages.addresses') }}</span>
        <span class="client-separator">></span>
        <span>{{ __('messages.edit_address') }}</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-profile-page">

                <h2>{{ __('messages.edit_address') }}</h2>

                <form class="client-profile-form">

                    <div class="client-form-grid">

                        <div class="client-form-group">
                            <label>{{ __('messages.full_name') }}</label>
                            <input type="text" name="nome" value="{{ $endereco->nome ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.mobile') }}</label>
                            <input type="text" name="celular" value="{{ $endereco->celular ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.zip_code') }}</label>
                            <input type="text" name="cep" value="{{ $endereco->cep ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.street') }}</label>
                            <input type="text" name="rua" value="{{ $endereco->rua ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.number') }}</label>
                            <input type="text" name="numero" value="{{ $endereco->numero ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.neighborhood') }}</label>
                            <input type="text" name="bairro" value="{{ $endereco->bairro ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.city') }}</label>
                            <input type="text" name="cidade" value="{{ $endereco->cidade ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.state') }}</label>
                            <input type="text" name="estado" value="{{ $endereco->estado ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.complement') }}</label>
                            <input type="text" name="complemento" value="{{ $endereco->complemento ?? '' }}">
                        </div>

                    </div>

                    <div class="client-profile-actions">

                        <a href="/cliente/enderecos" class="client-btn client-btn-secondary client-btn-link">
                            {{ __('messages.back') }}
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