@extends('layouts.app')

@section('content')

@php
    $productPlaceholder = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='360' viewBox='0 0 600 360'%3E%3Crect width='600' height='360' fill='%23f4f0ec'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%23a60a33' font-family='Arial' font-size='22'%3EInstrumental Store%3C/text%3E%3C/svg%3E";
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
                            src="{{ $produto->imagem_principal ? asset('storage/' . $produto->imagem_principal) : $productPlaceholder }}"
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

                                <a href="/carrinho" class="home-btn home-btn--primary">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                    {{ __('messages.add') }}
                                </a>

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
                            src="{{ $produto->imagem_principal ? asset('storage/' . $produto->imagem_principal) : $productPlaceholder }}"
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

                                <a href="/carrinho" class="home-btn home-btn--primary">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                    {{ __('messages.add') }}
                                </a>

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