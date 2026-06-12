@extends('layouts.app')

@section('content')

@php
    $productPlaceholder = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='360' viewBox='0 0 600 360'%3E%3Crect width='600' height='360' fill='%23f4f0ec'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%23b0003a' font-family='Arial' font-size='22'%3EInstrumental Store%3C/text%3E%3C/svg%3E";

    $imagemInstrumento = function ($produto) use ($productPlaceholder) {
        if (!empty($produto->imagem_principal)) {
            return asset('storage/' . $produto->imagem_principal);
        }

        $nomeBusca = strtolower(
            ($produto->nome ?? '') . ' ' .
            ($produto->categoria ?? '') . ' ' .
            ($produto->marca ?? '')
        );

        $termo = 'musical,instrument';

        if (str_contains($nomeBusca, 'violao') || str_contains($nomeBusca, 'violão')) {
            $termo = 'acoustic,guitar';
        } elseif (str_contains($nomeBusca, 'guitarra')) {
            $termo = 'electric,guitar';
        } elseif (str_contains($nomeBusca, 'baixo')) {
            $termo = 'bass,guitar';
        } elseif (str_contains($nomeBusca, 'bateria')) {
            $termo = 'drum,kit';
        } elseif (str_contains($nomeBusca, 'teclado')) {
            $termo = 'music,keyboard';
        } elseif (str_contains($nomeBusca, 'piano')) {
            $termo = 'piano';
        } elseif (str_contains($nomeBusca, 'microfone')) {
            $termo = 'microphone';
        } elseif (str_contains($nomeBusca, 'fone')) {
            $termo = 'headphones';
        } elseif (str_contains($nomeBusca, 'amplificador') || str_contains($nomeBusca, 'amplifica')) {
            $termo = 'guitar,amplifier';
        } elseif (str_contains($nomeBusca, 'caixa')) {
            $termo = 'audio,speaker';
        } elseif (str_contains($nomeBusca, 'cabo')) {
            $termo = 'audio,cable';
        } elseif (str_contains($nomeBusca, 'pedal')) {
            $termo = 'guitar,pedal';
        } elseif (str_contains($nomeBusca, 'palheta')) {
            $termo = 'guitar,pick';
        } elseif (str_contains($nomeBusca, 'corda')) {
            $termo = 'guitar,strings';
        } elseif (str_contains($nomeBusca, 'suporte')) {
            $termo = 'music,stand';
        }

        $lock = $produto->id ?? rand(1, 999);

        return 'https://loremflickr.com/600/400/' . $termo . '?lock=' . $lock;
    };

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
                        <img
                            src="{{ $imagemInstrumento($produto) }}"
                            alt="{{ $produto->nome }}"
                            onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';">
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

                <img
                    id="mainProductImage"
                    src="{{ $imagemInstrumento($produto) }}"
                    alt="{{ $produto->nome }}"
                    onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';">

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

                @php
                    $isFavorito = false;

                    if (auth()->check()) {
                        $isFavorito = \App\Models\Favorito::where('user_id', auth()->id())
                            ->where('produto_id', $produto->id)
                            ->exists();
                    }
                @endphp

                @if(auth()->check())
                    @if($isFavorito)
                        <form action="{{ route('cliente.favoritos.removerProduto', $produto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="product-favorite-icon-button" title="Remover dos Favoritos" style="color: #b0003a;">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">favorite</span>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('cliente.favoritos.store', $produto->id) }}" method="POST" style="display:inline;">
                            @csrf

                            <button type="submit" class="product-favorite-icon-button" title="Adicionar aos Favoritos">
                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">favorite</span>
                            </button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="product-favorite-icon-button" title="Faça login para favoritar" style="display: inline-block; text-decoration: none; color: inherit;">
                        <span class="material-symbols-outlined">favorite</span>
                    </a>
                @endif

            </div>

        </div>

    </section>

    <section class="product-detail-related">

        <h2>Produtos similares</h2>

        <div class="products-grid-page">

            @isset($produtosSimilares)

                @forelse ($produtosSimilares as $produtoSimilar)

                    <article class="product-page-card">

                        <img
                            src="{{ $imagemInstrumento($produtoSimilar) }}"
                            alt="{{ $produtoSimilar->nome }}"
                            onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';">

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

                                @php
                                    $isFavoritoSimilar = false;

                                    if (auth()->check()) {
                                        $isFavoritoSimilar = \App\Models\Favorito::where('user_id', auth()->id())
                                            ->where('produto_id', $produtoSimilar->id)
                                            ->exists();
                                    }
                                @endphp

                                @if(auth()->check())
                                    @if($isFavoritoSimilar)
                                        <form action="{{ route('cliente.favoritos.removerProduto', $produtoSimilar->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="product-favorite-icon-button" title="Remover dos Favoritos" style="color: #b0003a;">
                                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">favorite</span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('cliente.favoritos.store', $produtoSimilar->id) }}" method="POST" style="display:inline;">
                                            @csrf

                                            <button type="submit" class="product-favorite-icon-button" title="Adicionar aos Favoritos">
                                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">favorite</span>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="product-favorite-icon-button" title="Faça login para favoritar" style="display: inline-flex; align-items: center; text-decoration: none; color: inherit;">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </a>
                                @endif

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