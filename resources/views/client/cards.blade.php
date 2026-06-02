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
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-cards-page">

                <h2>{{ __('messages.cards') }}</h2>

                <div class="client-cards-grid">

                    @isset($cartoes)

                        @forelse ($cartoes as $cartao)

                            <article class="client-card-item">

                                <h3>
                                    {{ $cartao->nome ?? __('messages.card') }}
                                </h3>

                                <p>
                                    {{ $cartao->bandeira ?? '' }}
                                    {{ __('messages.card_ending') }}
                                    {{ $cartao->final ?? '' }}
                                    <br>

                                    {{ __('messages.expiration_date') }}:
                                    {{ $cartao->validade ?? '' }}
                                </p>

                                <div class="client-card-actions">

                                    <button type="button" class="client-card-edit">
                                        {{ __('messages.edit') }}
                                    </button>

                                    <button type="button" class="client-card-delete">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>

                                </div>

                            </article>

                        @empty

                            <p class="client-empty-message">
                                {{ __('messages.no_cards') }}
                            </p>

                        @endforelse

                    @else

                        <p class="client-empty-message">
                            {{ __('messages.cards_backend_message') }}
                        </p>

                    @endisset

                </div>

                <div class="client-card-new">
                    <button type="button" class="client-btn client-btn-primary">
                        {{ __('messages.register_new_card') }}
                    </button>
                </div>

            </section>

        </main>

    </div>

</div>

@endsection