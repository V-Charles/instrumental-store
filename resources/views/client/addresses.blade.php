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
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-address-page">

                <h2>{{ __('messages.addresses') }}</h2>

                <div class="client-address-grid">

                    @isset($enderecos)

                        @forelse ($enderecos as $endereco)

                            <article class="client-address-card">

                                <h3>
                                    {{ $endereco->nome ?? __('messages.address') }}
                                </h3>

                                <p>
                                    {{ $endereco->rua ?? '' }}, 
                                    {{ $endereco->numero ?? '' }},
                                    {{ $endereco->bairro ?? '' }} - 
                                    {{ __('messages.zip_code') }}
                                    {{ $endereco->cep ?? '' }}
                                    <br>
                                    {{ $endereco->cidade ?? '' }}/{{ $endereco->estado ?? '' }}
                                </p>

                                @if (!empty($endereco->telefone))
                                    <p>
                                        {{ $endereco->telefone }}
                                    </p>
                                @endif

                                <div class="client-address-actions">
                                    <button type="button" class="client-address-edit">
                                        {{ __('messages.edit') }}
                                    </button>

                                    <button type="button" class="client-address-delete">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </div>

                            </article>

                        @empty

                            <p class="client-empty-message">
                                {{ __('messages.no_addresses') }}
                            </p>

                        @endforelse

                    @else

                        <p class="client-empty-message">
                            {{ __('messages.addresses_backend_message') }}
                        </p>

                    @endisset

                </div>

                <div class="client-address-new">
                    <button type="button" class="client-btn client-btn-primary">
                        {{ __('messages.register_new_address') }}
                    </button>
                </div>

            </section>

        </main>

    </div>

</div>

@endsection