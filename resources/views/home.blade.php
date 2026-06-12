@extends('layouts.app')

@section('content')

@php
    $productPlaceholder = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='360' viewBox='0 0 600 360'%3E%3Crect width='600' height='360' fill='%23f4f0ec'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%23a60a33' font-family='Arial' font-size='22'%3EInstrumental Store%3C/text%3E%3C/svg%3E";

    function imagemInstrumentoHome($produto, $productPlaceholder) {
        $nomeBusca = strtolower(
            ($produto->nome ?? '') . ' ' .
            ($produto->categoria ?? '') . ' ' .
            ($produto->marca ?? '')
        );

        if (!empty($produto->imagem_principal)) {
            return asset('storage/' . $produto->imagem_principal);
        }

        if (str_contains($nomeBusca, 'violao') || str_contains($nomeBusca, 'violão')) {
            return 'https://images.unsplash.com/photo-1525201548942-d8732f6617a0?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'guitarra')) {
            return 'https://images.unsplash.com/photo-1516924962500-2b4b3b99ea02?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'baixo')) {
            return 'https://images.unsplash.com/photo-1510915361894-db8b60106cb1?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'bateria')) {
            return 'https://images.unsplash.com/photo-1519892300165-cb5542fb47c7?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'teclado') || str_contains($nomeBusca, 'piano')) {
            return 'https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'microfone')) {
            return 'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'fone')) {
            return 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'amplificador') || str_contains($nomeBusca, 'amplifica')) {
            return 'https://images.unsplash.com/photo-1550985616-10810253b84d?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'caixa') || str_contains($nomeBusca, 'speaker')) {
            return 'https://images.unsplash.com/photo-1545454675-3531b543be5d?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'cabo')) {
            return 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'pedal')) {
            return 'https://images.unsplash.com/photo-1598653222000-6b7b7a552625?auto=format&fit=crop&w=600&q=80';
        }

        if (str_contains($nomeBusca, 'palheta') || str_contains($nomeBusca, 'corda') || str_contains($nomeBusca, 'suporte')) {
            return 'https://images.unsplash.com/photo-1510915361894-db8b60106cb1?auto=format&fit=crop&w=600&q=80';
        }

        return $productPlaceholder;
    }
@endphp

<div class="home-page">

    <section class="home-hero">

        <div class="home-hero-banner">

            <img src="{{ asset('images/banner-home.jpg') }}" alt="Banner principal">

            <div class="home-hero-categories">

                @isset($categorias)

                    @foreach ($categorias as $categoria)

                        <a href="{{ route('products.index', ['categoria' => $categoria]) }}">
                            {{ $categoria }}
                        </a>

                    @endforeach

                @endisset

            </div>

            <div class="home-hero-overlay">

                <div class="home-hero-card">

                    <h1>{!! __('messages.hero_title') !!}</h1>

                    <p class="home-hero-description">
                        {{ __('messages.hero_description') }}
                    </p>

                    <a href="{{ route('products.index') }}" class="home-hero-button">
                        {{ __('messages.buy') }}
                    </a>

                </div>

            </div>

        </div>

    </section>

    <section class="home-section">

        <h2 class="home-section-title">
            {{ __('messages.best_sellers') }}
        </h2>

        <p class="home-section-subtitle">
            {{ __('messages.best_sellers_subtitle') }}
        </p>

        <div class="home-products-grid">

            @isset($produtosDestaque)

                @forelse ($produtosDestaque as $produto)

                    <article class="home-product-card">

                        <img
                            src="{{ imagemInstrumentoHome($produto, $productPlaceholder) }}"
                            alt="{{ $produto->nome }}"
                            onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';">

                        <div class="home-product-info">

                            <p class="home-product-brand">
                                {{ $produto->categoria }}
                            </p>

                            <h3>{{ $produto->nome }}</h3>

                            <p class="home-product-price">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </p>

                            <div class="home-product-actions">

                                <form action="{{ route('cart.add', $produto->id) }}" method="POST">
                                    @csrf

                                    <button type="submit" class="home-btn home-btn--primary">
                                        <span class="material-symbols-outlined">
                                            shopping_cart
                                        </span>

                                        {{ __('messages.add') }}
                                    </button>
                                </form>

                                <a href="{{ route('products.show', $produto->id) }}" class="home-btn home-btn--secondary">
                                    {{ __('messages.details') }}
                                </a>

                            </div>

                        </div>

                    </article>

                @empty

                    <p class="client-empty-message">
                        {{ __('messages.home_products_backend_message') }}
                    </p>

                @endforelse

            @else

                <p class="client-empty-message">
                    {{ __('messages.home_products_backend_message') }}
                </p>

            @endisset

        </div>

    </section>

    <section class="home-shipping">

        <div class="home-shipping-wrapper">

            <button class="home-shipping-arrow" onclick="prevShipping()">
                ‹
            </button>

            <div class="home-shipping-banner">
                <img id="shippingImage" src="{{ asset('images/frete-1.png') }}" alt="Frete grátis">
            </div>

            <button class="home-shipping-arrow" onclick="nextShipping()">
                ›
            </button>

        </div>

    </section>

    <section class="home-other">

        <h2>
            {{ __('messages.other_products') }}
        </h2>

        <div class="home-other-grid">

            @isset($outrosProdutos)

                @forelse ($outrosProdutos as $produto)

                    <article class="home-other-card">

                        <img
                            src="{{ imagemInstrumentoHome($produto, $productPlaceholder) }}"
                            alt="{{ $produto->nome }}"
                            onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';">

                        <div class="home-other-info">

                            <p class="home-other-brand">
                                {{ $produto->categoria }}
                            </p>

                            <h3>{{ $produto->nome }}</h3>

                            <p class="home-other-price">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </p>

                            <div class="home-other-actions">

                                <form action="{{ route('cart.add', $produto->id) }}" method="POST">
                                    @csrf

                                    <button type="submit" class="home-btn home-btn--primary">
                                        <span class="material-symbols-outlined">
                                            shopping_cart
                                        </span>

                                        {{ __('messages.add') }}
                                    </button>
                                </form>

                                <a href="{{ route('products.show', $produto->id) }}" class="home-btn home-btn--secondary">
                                    {{ __('messages.details') }}
                                </a>

                            </div>

                        </div>

                    </article>

                @empty

                    <p class="client-empty-message">
                        {{ __('messages.home_products_backend_message') }}
                    </p>

                @endforelse

            @else

                <p class="client-empty-message">
                    {{ __('messages.home_products_backend_message') }}
                </p>

            @endisset

        </div>

    </section>

</div>

@endsection