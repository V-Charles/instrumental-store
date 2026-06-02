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
        <span>{{ __('messages.personal_data') }}</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-profile-page">

                <h2>{{ __('messages.personal_data') }}</h2>

                @isset($cliente)

                    <div class="client-form-grid">

                        <div class="client-form-group">
                            <label>{{ __('messages.full_name') }}</label>
                            <input type="text" value="{{ $cliente->nome_completo ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.birth_date') }}</label>
                            <input type="text" value="{{ $cliente->data_nascimento ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.cpf') }}</label>
                            <input type="text" value="{{ $cliente->cpf ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.email') }}</label>
                            <input type="email" value="{{ $cliente->email ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.mobile') }}</label>
                            <input type="text" value="{{ $cliente->celular ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.gender') }}</label>
                            <input type="text" value="{{ $cliente->sexo ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.zip_code') }}</label>
                            <input type="text" value="{{ $cliente->cep ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.street') }}</label>
                            <input type="text" value="{{ $cliente->rua ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.number') }}</label>
                            <input type="text" value="{{ $cliente->numero ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.neighborhood') }}</label>
                            <input type="text" value="{{ $cliente->bairro ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.city') }}</label>
                            <input type="text" value="{{ $cliente->cidade ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.state') }}</label>
                            <input type="text" value="{{ $cliente->estado ?? '' }}" readonly>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.country') }}</label>
                            <input type="text" value="{{ $cliente->pais ?? '' }}" readonly>
                        </div>

                    </div>

                @else

                    <p class="client-empty-message">
                        {{ __('messages.personal_data_backend_message') }}
                    </p>

                @endisset

                <div class="client-profile-actions">
                    <a href="/cliente/configuracao" class="client-btn client-btn-primary client-btn-link">
                        {{ __('messages.edit') }}
                    </a>
                </div>

            </section>

        </main>

    </div>

</div>

@endsection