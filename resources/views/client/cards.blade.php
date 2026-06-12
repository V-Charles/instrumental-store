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

                @if (session('success'))
                    <p class="success-message">
                        {{ session('success') }}
                    </p>
                @endif

                <div class="client-cards-grid">

                    @forelse ($cartoes as $cartao)

                        @php
                            $numero = preg_replace('/\D/', '', $cartao->numero_cartao ?? '');
                            $final = strlen($numero) >= 4 ? substr($numero, -4) : '';

                            $tipoCartao = $cartao->tipo_cartao === 'credito'
                                ? __('messages.credit_card')
                                : __('messages.debit_card');
                        @endphp

                        <article class="client-card-item">

                            <h3>
                                {{ $cartao->apelido_cartao ?: __('messages.card') }}
                            </h3>

                            <p>
                                {{ $cartao->bandeira ?? 'Cartão' }}
                                {{ __('messages.card_ending') }}
                                {{ $final }}

                                <br>

                                {{ $tipoCartao }}

                                <br>

                                {{ __('messages.expiration_date') }}:
                                {{ $cartao->validade ?? '' }}
                            </p>

                            <div class="client-card-actions">

                                <a 
                                    href="{{ route('cliente.cartoes.edit', $cartao->id) }}" 
                                    class="client-card-edit"
                                >
                                    {{ __('messages.edit') }}
                                </a>

                                <form 
                                    action="{{ route('cliente.cartoes.destroy', $cartao->id) }}" 
                                    method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este cartão?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="client-card-delete">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>

                            </div>

                        </article>

                    @empty

                        <p class="client-empty-message">
                            {{ __('messages.no_cards') }}
                        </p>

                    @endforelse

                </div>

                <div class="client-card-new">
                    <a href="{{ route('cliente.cartoes.create') }}" class="client-btn client-btn-primary">
                        {{ __('messages.register_new_card') }}
                    </a>
                </div>

            </section>

        </main>

    </div>

</div>

@endsection