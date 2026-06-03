@extends('layouts.app')

@section('content')

@php
    $imagensExtras = $produto->imagens_extras ?? [];

    if (is_string($imagensExtras)) {
        $imagensExtras = json_decode($imagensExtras, true) ?? [];
    }
@endphp

<div class="product-detail-page">

    <div class="product-detail-breadcrumb">
        <a href="{{ route('home') }}">
            Início
        </a>

        <span>></span>

        <a href="{{ route('products.index') }}">
            Produtos
        </a>

        <span>></span>

        <span>{{ $produto->nome }}</span>
    </div>

    <section class="product-detail-main">

        <div class="product-detail-gallery">

            <div class="product-detail-thumbs">

                @if ($produto->imagem_principal)
                    <button type="button" class="product-thumb active">
                        <img
                            src="{{ asset('storage/' . $produto->imagem_principal) }}"
                            alt="{{ $produto->nome }}">
                    </button>
                @else
                    <button type="button" class="product-thumb active">
                        <div class="product-thumb-placeholder">
                            IS
                        </div>
                    </button>
                @endif

                @foreach ($imagensExtras as $imagemExtra)

                    <button type="button" class="product-thumb">
                        <img
                            src="{{ asset('storage/' . $imagemExtra) }}"
                            alt="{{ $produto->nome }}">
                    </button>

                @endforeach

            </div>

            <div class="product-detail-image">

                @if ($produto->imagem_principal)
                    <img
                        id="mainProductImage"
                        src="{{ asset('storage/' . $produto->imagem_principal) }}"
                        alt="{{ $produto->nome }}">
                @else
                    <div class="product-image-placeholder">
                        Instrumental Store
                    </div>
                @endif

            </div>

        </div>

        <div class="product-detail-info">

            <h1>{{ $produto->nome }}</h1>

            <p class="product-detail-brand">
                {{ $produto->marca ?? $produto->categoria ?? '' }}
            </p>

            @if ($produto->descricao)
                <p class="product-detail-description">
                    {{ $produto->descricao }}
                </p>
            @endif

            <p class="product-detail-price">
                R$ {{ number_format($produto->preco, 2, ',', '.') }}
            </p>

            @if (!is_null($produto->quantidade))
                <p class="product-detail-stock">
                    {{ $produto->quantidade }} itens disponíveis
                </p>
            @endif

            <div class="product-detail-quantity">
                <button type="button" id="decreaseQuantity">-</button>
                <span id="productQuantity">1</span>
                <button type="button" id="increaseQuantity">+</button>
            </div>

            <div class="product-detail-actions">

                <form action="{{ route('cart.add', $produto->id) }}" method="POST">
                    @csrf

                    <button type="submit" class="product-detail-add">
                        <span class="material-symbols-outlined">
                            shopping_cart
                        </span>

                        Adicionar
                    </button>
                </form>

                <a href="/carrinho" class="product-detail-buy">
                    Comprar
                </a>

            </div>

        </div>

    </section>

    <section class="product-detail-related">

        <h2>Produtos similares</h2>

        <div class="products-grid-page">

            @isset($produtosSimilares)

                @forelse ($produtosSimilares as $produtoSimilar)

                    <article class="product-page-card">

                        @if ($produtoSimilar->imagem_principal)
                            <img
                                src="{{ asset('storage/' . $produtoSimilar->imagem_principal) }}"
                                alt="{{ $produtoSimilar->nome }}">
                        @else
                            <div class="product-card-placeholder">
                                Instrumental Store
                            </div>
                        @endif

                        <div class="product-page-info">

                            <p class="product-page-brand">
                                {{ $produtoSimilar->marca ?? $produtoSimilar->categoria ?? '' }}
                            </p>

                            <h3>
                                {{ $produtoSimilar->nome }}
                            </h3>

                            <p class="product-page-price">
                                R$ {{ number_format($produtoSimilar->preco, 2, ',', '.') }}
                            </p>

                            <div class="product-page-actions">

                                <form action="{{ route('cart.add', $produtoSimilar->id) }}" method="POST">
                                    @csrf

                                    <button type="submit" class="home-btn home-btn--primary">
                                        <span class="material-symbols-outlined">
                                            shopping_cart
                                        </span>

                                        Adicionar
                                    </button>
                                </form>

                                <a href="{{ route('products.show', $produtoSimilar->id) }}" class="home-btn home-btn--secondary">
                                    Detalhes
                                </a>

                            </div>

                        </div>

                    </article>

                @empty

                    <p class="products-empty-message">
                        Nenhum produto similar encontrado.
                    </p>

                @endforelse

            @endisset

        </div>

    </section>

    <div class="product-detail-back">
        <a href="{{ route('products.index') }}">
            Voltar
        </a>
    </div>

</div>

@endsection