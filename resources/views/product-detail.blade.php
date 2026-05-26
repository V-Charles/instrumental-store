@extends('layouts.app')

@section('content')

@php
    $produtoDisponivel = isset($produto);

    $imagensExtras = $produtoDisponivel ? ($produto->imagens_extras ?? []) : [];

    if (is_string($imagensExtras)) {
        $imagensExtras = json_decode($imagensExtras, true) ?? [];
    }

    $imagemPrincipal = $produtoDisponivel ? ($produto->imagem_principal ?? null) : null;

    $galeria = collect([$imagemPrincipal])
        ->merge($imagensExtras)
        ->filter()
        ->values();

    $cores = $produtoDisponivel ? ($produto->cores ?? []) : [];

    if (is_string($cores)) {
        $cores = json_decode($cores, true) ?? [];
    }
@endphp

<div class="product-detail-page">

    <section class="product-detail-breadcrumb">
        <a href="{{ route('products.index') }}">{{ __('messages.products') }}</a>
        <span>/</span>
        <span>{{ $produtoDisponivel ? $produto->nome : 'Produto' }}</span>
    </section>

    <section class="product-detail-main">

        <div class="product-detail-gallery">

            <div class="product-detail-thumbs">
                @forelse ($galeria as $index => $imagem)
                    <button 
                        type="button" 
                        class="product-thumb {{ $index === 0 ? 'active' : '' }}" 
                        data-image="{{ asset('storage/' . $imagem) }}">
                        <img src="{{ asset('storage/' . $imagem) }}" alt="{{ $produtoDisponivel ? $produto->nome : 'Produto' }}">
                    </button>
                @empty
                    <button 
                        type="button" 
                        class="product-thumb active" 
                        data-image="{{ asset('images/placeholder-produto.jpg') }}">
                        <img src="{{ asset('images/placeholder-produto.jpg') }}" alt="Produto">
                    </button>
                @endforelse
            </div>

            <div class="product-detail-image">
                <img 
                    id="mainProductImage" 
                    src="{{ $galeria->isNotEmpty() ? asset('storage/' . $galeria[0]) : asset('images/placeholder-produto.jpg') }}" 
                    alt="{{ $produtoDisponivel ? $produto->nome : 'Produto' }}">
            </div>

        </div>

        <div class="product-detail-info">
            <p class="product-detail-brand">
                {{ $produtoDisponivel ? ($produto->marca ?? '') : '' }}
            </p>

            <h1>
                {{ $produtoDisponivel ? $produto->nome : 'Produto' }}
            </h1>

            <p class="product-detail-description">
                {{ $produtoDisponivel ? ($produto->descricao ?? '') : 'As informações do produto serão carregadas pelo banco de dados.' }}
            </p>

            <p class="product-detail-price">
                @if ($produtoDisponivel)
                    R$ {{ number_format($produto->preco, 2, ',', '.') }}
                @else
                    R$ 0,00
                @endif
            </p>

            @if (!empty($cores))
                <div class="product-detail-colors">
                    @foreach ($cores as $index => $cor)
                        <button 
                            type="button" 
                            class="product-color {{ $index === 0 ? 'active' : '' }}"
                            style="background: {{ $cor }};">
                        </button>
                    @endforeach
                </div>
            @endif

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

            @isset($produtosSimilares)
                @forelse ($produtosSimilares as $produtoSimilar)
                    <article class="home-product-card">
                        <img 
                            src="{{ $produtoSimilar->imagem_principal ? asset('storage/' . $produtoSimilar->imagem_principal) : asset('images/placeholder-produto.jpg') }}" 
                            alt="{{ $produtoSimilar->nome }}">

                        <div class="home-product-info">
                            <p class="home-product-brand">
                                {{ $produtoSimilar->marca ?? '' }}
                            </p>

                            <h3>
                                {{ $produtoSimilar->nome }}
                            </h3>

                            <p class="home-product-price">
                                R$ {{ number_format($produtoSimilar->preco, 2, ',', '.') }}
                            </p>

                            <div class="home-product-actions">
                                <a href="/carrinho" class="home-btn home-btn--primary">
                                    <span class="material-symbols-outlined">shopping_cart</span>
                                    {{ __('messages.add') }}
                                </a>

                                <a href="{{ route('product.detail', $produtoSimilar->id) }}" class="home-btn home-btn--secondary">
                                    {{ __('messages.details') }}
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <p>Nenhum produto similar encontrado.</p>
                @endforelse
            @else
                <p>Produtos similares serão carregados pelo banco de dados.</p>
            @endisset

        </div>

        <div class="product-detail-back">
            <a href="{{ $produtoDisponivel ? route('products.index', ['categoria' => $produto->categoria]) : route('products.index') }}">
                {{ __('messages.view_more') }}
            </a>
        </div>
    </section>

</div>

@endsection