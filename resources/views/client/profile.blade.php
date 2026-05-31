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

                <form class="client-profile-form">

                    <div class="client-form-grid">

                        <div class="client-form-group">
                            <label>{{ __('messages.full_name') }} *</label>
                            <input type="text" name="nome_completo" value="{{ $cliente->nome_completo ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.birth_date') }} *</label>
                            <input type="date" name="data_nascimento" value="{{ $cliente->data_nascimento ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.cpf') }} *</label>
                            <input type="text" name="cpf" value="{{ $cliente->cpf ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.email') }}</label>
                            <input type="email" name="email" value="{{ $cliente->email ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.mobile') }} *</label>
                            <input type="text" name="celular" value="{{ $cliente->celular ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.gender') }} *</label>
                            <select name="sexo">
                                <option value="">{{ __('messages.select_option') }}</option>
                                <option value="feminino" {{ ($cliente->sexo ?? '') === 'feminino' ? 'selected' : '' }}>
                                    {{ __('messages.female') }}
                                </option>
                                <option value="masculino" {{ ($cliente->sexo ?? '') === 'masculino' ? 'selected' : '' }}>
                                    {{ __('messages.male') }}
                                </option>
                                <option value="nao_informar" {{ ($cliente->sexo ?? '') === 'nao_informar' ? 'selected' : '' }}>
                                    {{ __('messages.prefer_not_to_say') }}
                                </option>
                            </select>
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.zip_code') }}</label>
                            <input type="text" name="cep" value="{{ $cliente->cep ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.street') }} *</label>
                            <input type="text" name="rua" value="{{ $cliente->rua ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.number') }} *</label>
                            <input type="text" name="numero" value="{{ $cliente->numero ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.neighborhood') }} *</label>
                            <input type="text" name="bairro" value="{{ $cliente->bairro ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.city') }} *</label>
                            <input type="text" name="cidade" value="{{ $cliente->cidade ?? '' }}">
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.country') }} *</label>
                            <input type="text" name="pais" value="{{ $cliente->pais ?? '' }}">
                        </div>

                    </div>

                    <div class="client-profile-actions">

                        <button type="button" class="client-btn client-btn-secondary">
                            {{ __('messages.edit') }}
                        </button>

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