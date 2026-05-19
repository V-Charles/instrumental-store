@extends('layouts.app')

@section('content')
<div class="product-detail-page">

    <section class="product-detail-breadcrumb">
        <a href="{{ route('products.index') }}">{{ __('messages.products') }}</a>
        <span>/</span>
        <span>Guitarra Stratocaster</span>
    </section>

    <section class="product-detail-main">

        <div class="product-detail-gallery">

            <div class="product-detail-thumbs">
                <button type="button" class="product-thumb active" data-image="{{ asset('images/guitarra-stratocaster-cor-1.jpg') }}">
                    <img src="{{ asset('images/guitarra-stratocaster-cor-1.jpg') }}" alt="Guitarra cor 1">
                </button>

                <button type="button" class="product-thumb" data-image="{{ asset('images/guitarra-stratocaster-cor-2.jpg') }}">
                    <img src="{{ asset('images/guitarra-stratocaster-cor-2.jpg') }}" alt="Guitarra cor 2">
                </button>

                <button type="button" class="product-thumb" data-image="{{ asset('images/guitarra-stratocaster-cor-3.jpg') }}">
                    <img src="{{ asset('images/guitarra-stratocaster-cor-3.jpg') }}" alt="Guitarra cor 3">
                </button>
            </div>

            <div class="product-detail-image">
                <img id="mainProductImage" src="{{ asset('images/guitarra-stratocaster-cor-1.jpg') }}" alt="Guitarra Stratocaster">
            </div>

        </div>

        <div class="product-detail-info">
            <p class="product-detail-brand">Fender</p>

            <h1>Guitarra Stratocaster</h1>

            <p class="product-detail-description">
                {{ __('messages.product_detail_description') }}
            </p>

            <p class="product-detail-price">R$ 3.499,90</p>

            <p class="product-detail-stock">
                {{ __('messages.in_stock', ['count' => $product->stock ?? 15]) }}
            </p>

            <div class="product-detail-colors">
                <button type="button" class="product-color active" data-image="{{ asset('images/guitarra-stratocaster-cor-1.jpg') }}" style="background:#b0003a;"></button>
                <button type="button" class="product-color" data-image="{{ asset('images/guitarra-stratocaster-cor-2.jpg') }}" style="background:#111111;"></button>
                <button type="button" class="product-color" data-image="{{ asset('images/guitarra-stratocaster-cor-3.jpg') }}" style="background:#f4c430;"></button>
            </div>

            <div class="product-detail-quantity">
                <button type="button" id="decreaseQuantity">-</button>
                <span id="productQuantity">1</span>
                <button type="button" id="increaseQuantity">+</button>
            </div>

            <div class="product-detail-actions">
                <a href="/carrinho" class="product-detail-add">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    {{ __('messages.add') }}
                </a>

                <a href="/compra" class="product-detail-buy">
                    {{ __('messages.buy') }}
                </a>
            </div>
        </div>

    </section>

    <section class="product-detail-related">
        <h2>{{ __('messages.similar_products') }}</h2>

        <div class="home-products-grid">

            <article class="home-product-card">
                <img src="{{ asset('images/violao-acustico-folk.jpg') }}" alt="Produto">
                <div class="home-product-info">
                    <p class="home-product-brand">Giannini</p>
                    <h3>Violão Acústico Folk</h3>
                    <p class="home-product-price">R$ 1.299,90</p>
                    <p class="home-product-stock">{{ __('messages.in_stock', ['count' => 15]) }}</p>

                    <div class="home-product-actions">
                        <button class="home-btn home-btn--primary">
                            <span class="material-symbols-outlined">shopping_cart</span>
                            {{ __('messages.add') }}
                        </button>

                        <a href="{{ route('product.detail', 'violao-acustico-folk') }}" class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </a>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/guitarra-les-paul.jpg') }}" alt="Produto">
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

                        <a href="{{ route('product.detail', 'guitarra-les-paul') }}" class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </a>
                    </div>
                </div>
            </article>

            <article class="home-product-card">
                <img src="{{ asset('images/violao-classico-nylon.jpg') }}" alt="Produto">
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

                        <a href="{{ route('product.detail', 'violao-classico-nylon') }}" class="home-btn home-btn--secondary">
                            {{ __('messages.details') }}
                        </a>
                    </div>
                </div>
            </article>

        </div>

        <div class="product-detail-back">
            <a href="{{ route('products.index') }}">
                {{ __('messages.back') }}
            </a>
        </div>
    </section>

</div>
@endsection