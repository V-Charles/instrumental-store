@extends('layouts.app')

@section('content')
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
                @else
                    <a href="{{ route('products.index') }}">
                        {{ __('messages.products') }}
                    </a>
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
                            src="{{ $produto->imagem_principal ? asset('storage/' . $produto->imagem_principal) : asset('images/placeholder-produto.jpg') }}" 
                            alt="{{ $produto->nome }}">

                        <div class="home-product-info">

                            <p class="home-product-brand">
                                {{ $produto->marca ?? '' }}
                            </p>

                            <h3>
                                {{ $produto->nome }}
                            </h3>

                            <p class="home-product-price">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </p>

                            <div class="home-product-actions">

                                <a href="/carrinho" class="home-btn home-btn--primary">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                    {{ __('messages.add') }}
                                </a>

                                <a href="{{ route('product.detail', $produto->id) }}" class="home-btn home-btn--secondary">
                                    {{ __('messages.details') }}
                                </a>

                            </div>

                        </div>

                    </article>

                @empty

                    <p class="home-empty-message">
                        {{ __('messages.no_products') }}
                    </p>

                @endforelse

            @else

                <p class="home-empty-message">
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
                            src="{{ $produto->imagem_principal ? asset('storage/' . $produto->imagem_principal) : asset('images/placeholder-produto.jpg') }}" 
                            alt="{{ $produto->nome }}">

                        <div class="home-other-info">

                            <p class="home-other-brand">
                                {{ $produto->marca ?? '' }}
                            </p>

                            <h3>
                                {{ $produto->nome }}
                            </h3>

                            <p class="home-other-price">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </p>

                            <div class="home-other-actions">

                                <a href="/carrinho" class="home-btn home-btn--primary">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                    {{ __('messages.add') }}
                                </a>

                                <a href="{{ route('product.detail', $produto->id) }}" class="home-btn home-btn--secondary">
                                    {{ __('messages.details') }}
                                </a>

                            </div>

                        </div>

                    </article>

                @empty

                    <p class="home-empty-message">
                        {{ __('messages.no_products') }}
                    </p>

                @endforelse

            @else

                <p class="home-empty-message">
                    {{ __('messages.home_products_backend_message') }}
                </p>

            @endisset

        </div>

    </section>

</div>
@endsection