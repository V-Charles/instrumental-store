@extends('layouts.app')

@section('content')
<div class="home-page">

    <!-- =========================================================
         HERO
    ========================================================== -->
    <section class="home-hero">
    <div class="home-hero-banner">
    <img src="{{ asset('images/banner-home.jpg') }}" alt="Banner principal">

<div class="home-hero-categories">
    <a href="{{ route('products.index', ['categoria' => 'acessorios']) }}">
    {{ __('messages.accessories') }}
    </a>

    <a href="{{ route('products.index', ['categoria' => 'cordas']) }}">
    {{ __('messages.strings') }}
    </a>

    <a href="{{ route('products.index', ['categoria' => 'amplificadores']) }}">
    {{ __('messages.amplifiers') }}
    </a>

    <a href="{{ route('products.index', ['categoria' => 'pedais-pedaleiras']) }}">
    {{ __('messages.pedals') }}
    </a>

    <a href="{{ route('products.index', ['categoria' => 'percussao']) }}">
    {{ __('messages.percussion') }}
    </a>

    <a href="{{ route('products.index', ['categoria' => 'audio-tecnologia']) }}">
    {{ __('messages.audio_tech') }}
    </a>

    <a href="{{ route('products.index', ['categoria' => 'sopro']) }}">
    {{ __('messages.wind') }}
    </a>
</div>

    <div class="home-hero-overlay">
    <div class="home-hero-card">
    <h1>{!! __('messages.hero_title') !!}</h1>

    <p class="home-hero-description">
    {{ __('messages.hero_description') }}
    </p>

    <a href="/produtos" class="home-hero-button">
    {{ __('messages.buy') }}
    </a>
    </div>
    </div>
    </div>
    </section>

    <!-- =========================================================
         PRODUTOS MAIS VENDIDOS
    ========================================================== -->
    <section class="home-section">
        <h2 class="home-section-title">{{ __('messages.best_sellers') }}</h2>
        <p class="home-section-subtitle">
            {{ __('messages.best_sellers_subtitle') }}
        </p>

        <div class="home-products-grid">

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-1.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Fender</p>
                    <h3>Guitarra Stratocaster</h3>
                    <p class="home-product-price">R$ 3.499,90</p>
                    <p class="home-product-stock">{{ __('messages.in_stock', ['count' => 15]) }}</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-2.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Gibson</p>
                    <h3>Guitarra Les Paul</h3>
                    <p class="home-product-price">R$ 4.299,90</p>
                    <p class="home-product-stock">{{ __('messages.in_stock', ['count' => 10]) }}</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-3.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Yamaha</p>
                    <h3>Violão Acústico Folk</h3>
                    <p class="home-product-price">R$ 1.899,90</p>
                    <p class="home-product-stock">{{ __('messages.in_stock', ['count' => 20]) }}</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-4.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Giannini</p>
                    <h3>Violão Clássico Nylon</h3>
                    <p class="home-product-price">R$ 1.299,90</p>
                    <p class="home-product-stock">{{ __('messages.in_stock', ['count' => 25]) }}</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-5.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Pearl</p>
                    <h3>Bateria Acústica Completa</h3>
                    <p class="home-product-price">R$ 5.999,90</p>
                    <p class="home-product-stock">{{ __('messages.in_stock', ['count' => 5]) }}</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/mais-vendido-6.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Roland</p>
                    <h3>Bateria Eletrônica</h3>
                    <p class="home-product-price">R$ 3.799,90</p>
                    <p class="home-product-stock">{{ __('messages.in_stock', ['count' => 12]) }}</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

        </div>
    </section>

    <!-- =========================================================
         BANNER FRETE
    ========================================================== -->
    <section class="home-shipping">
        <div class="home-shipping-wrapper">

            <button class="home-shipping-arrow" onclick="prevShipping()">‹</button>

            <div class="home-shipping-banner">
                <img id="shippingImage" src="{{ asset('images/frete-1.png') }}" alt="Frete grátis">
            </div>

            <button class="home-shipping-arrow" onclick="nextShipping()">›</button>

        </div>
    </section>

    <!-- =========================================================
         OUTROS PRODUTOS
    ========================================================== -->
    <section class="home-other">
        <h2>{{ __('messages.other_products') }}</h2>

        <div class="home-other-grid">

            <article class="home-other-card">
                <img src="{{ asset('images/outro-1.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Ibanez</p>
                    <h3>Contrabaixo 4 cordas</h3>
                    <p class="home-other-price">R$ 2.459,90</p>
                    <p class="home-other-stock">{{ __('messages.in_stock', ['count' => 15]) }}</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="home-other-card">
                <img src="{{ asset('images/outro-2.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Music Man</p>
                    <h3>Contrabaixo 5 cordas</h3>
                    <p class="home-other-price">R$ 3.299,90</p>
                    <p class="home-other-stock">{{ __('messages.in_stock', ['count' => 5]) }}</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="home-other-card">
                <img src="{{ asset('images/outro-3.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Casio</p>
                    <h3>Teclado 61 teclas</h3>
                    <p class="home-other-price">R$ 1.799,90</p>
                    <p class="home-other-stock">{{ __('messages.in_stock', ['count' => 18]) }}</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="home-other-card">
                <img src="{{ asset('images/outro-4.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Yamaha</p>
                    <h3>Piano Digital 88 Teclas</h3>
                    <p class="home-other-price">R$ 4.599,90</p>
                    <p class="home-other-stock">{{ __('messages.in_stock', ['count' => 7]) }}</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="home-other-card">
                <img src="{{ asset('images/outro-5.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Hofma</p>
                    <h3>Violino 4/4 Completo</h3>
                    <p class="home-other-price">R$ 2.199,90</p>
                    <p class="home-other-stock">{{ __('messages.in_stock', ['count' => 12]) }}</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

            <article class="home-other-card">
                <img src="{{ asset('images/outro-6.jpg') }}" alt="Produto">
                <div class="home-other-info">
                    <p class="home-other-brand">Weril</p>
                    <h3>Saxofone Alto</h3>
                    <p class="home-other-price">R$ 3.899,90</p>
                    <p class="home-other-stock">{{ __('messages.in_stock', ['count' => 9]) }}</p>

                    <div class="home-other-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>
                        <button class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </button>
                    </div>
                </div>
            </article>

        </div>
    </section>

</div>
@endsection