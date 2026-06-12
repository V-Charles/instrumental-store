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
@endphp

<div class="products-page">

    <section class="products-hero">
        <img src="{{ asset('images/banner-produtos.jpg') }}" alt="{{ __('messages.products') }}">

        <div class="products-hero-content">
            <h1>{{ __('messages.products') }}</h1>
        </div>
    </section>

    <section class="products-filter-bar">
        <div class="products-filter-left">
            <span class="material-symbols-outlined">tune</span>

            <strong>{{ __('messages.filter') }}</strong>

            <form method="GET" action="{{ route('products.index') }}">
                <select 
                    name="categoria" 
                    class="products-category-input"
                    onchange="this.form.submit()">

                    <option value="todos">
                        {{ __('messages.all_items') }}
                    </option>

                    @isset($categorias)
                        @foreach ($categorias as $categoria)
                            <option 
                                value="{{ $categoria }}"
                                {{ request('categoria') === $categoria ? 'selected' : '' }}>
                                {{ $categoria }}
                            </option>
                        @endforeach
                    @endisset

                </select>
            </form>
        </div>

        <div class="products-filter-divider"></div>

        <p>
            @isset($produtos)
                {{ $produtos->total() }} {{ __('messages.results') }}
            @else
                {{ __('messages.showing_products') }}
            @endisset
        </p>
    </section>

    <section class="products-list">

        <div class="products-grid-page">

            @isset($produtos)

                @forelse ($produtos as $produto)

                    <article class="product-page-card">

                        <img 
                            src="{{ $imagemInstrumento($produto) }}" 
                            alt="{{ $produto->nome }}"
                            onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';">

                        <div class="product-page-info">

                            <p class="product-page-brand">
                                {{ $produto->marca ?? $produto->categoria ?? '' }}
                            </p>

                            <h3>
                                {{ $produto->nome }}
                            </h3>

                            <p class="product-page-price">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </p>

                            <div class="product-page-actions">

                                <form action="{{ route('cart.add', $produto->id) }}" method="POST" style="margin: 0;">
                                    @csrf

                                    <button type="submit" class="home-btn home-btn--primary" style="border: none; cursor: pointer; width: 100%;">
                                        <span class="material-symbols-outlined">shopping_cart</span>
                                        {{ __('messages.add') }}
                                    </button>
                                </form>

                                <a href="{{ route('products.show', $produto->id) }}" class="home-btn home-btn--secondary">
                                    {{ __('messages.details') }}
                                </a>

                                @php
                                    $isFavCat = false;

                                    if (auth()->check()) {
                                        $isFavCat = \App\Models\Favorito::where('user_id', auth()->id())
                                            ->where('produto_id', $produto->id)
                                            ->exists();
                                    }
                                @endphp

                                @if(auth()->check())
                                    @if($isFavCat)
                                        <form action="{{ route('cliente.favoritos.removerProduto', $produto->id) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="product-favorite-icon-button" title="Remover dos Favoritos">
                                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">favorite</span>
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('cliente.favoritos.store', $produto->id) }}" method="POST" style="margin: 0;">
                                            @csrf

                                            <button type="submit" class="product-favorite-icon-button" title="Adicionar aos Favoritos">
                                                <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 0;">favorite</span>
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="product-favorite-icon-button" title="Faça login para favoritar" style="text-decoration: none;">
                                        <span class="material-symbols-outlined">favorite</span>
                                    </a>
                                @endif

                            </div>

                        </div>

                    </article>

                @empty

                    <p class="products-empty-message">
                        {{ __('messages.no_products') }}
                    </p>

                @endforelse

            @else

                <p class="products-empty-message">
                    {{ __('messages.products_backend_message') }}
                </p>

            @endisset

        </div>

        @isset($produtos)

            @if ($produtos->hasPages())

                <div class="products-pagination">

                    @if ($produtos->onFirstPage())
                        <span class="products-page-link products-page-link-disabled">
                            ‹
                        </span>
                    @else
                        <a href="{{ $produtos->previousPageUrl() }}" class="products-page-link">
                            ‹
                        </a>
                    @endif

                    @for ($page = 1; $page <= $produtos->lastPage(); $page++)

                        @if ($page == $produtos->currentPage())
                            <span class="products-page-link active">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $produtos->url($page) }}" class="products-page-link">
                                {{ $page }}
                            </a>
                        @endif

                    @endfor

                    @if ($produtos->hasMorePages())
                        <a href="{{ $produtos->nextPageUrl() }}" class="products-page-link">
                            ›
                        </a>
                    @else
                        <span class="products-page-link products-page-link-disabled">
                            ›
                        </span>
                    @endif

                </div>

            @endif

        @endisset

    </section>

</div>

@endsection