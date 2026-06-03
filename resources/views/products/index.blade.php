@extends('layouts.app')

@section('content')

@php
    $productPlaceholder = "data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='600' height='360' viewBox='0 0 600 360'%3E%3Crect width='600' height='360' fill='%23f4f0ec'/%3E%3Ctext x='50%25' y='50%25' dominant-baseline='middle' text-anchor='middle' fill='%23b0003a' font-family='Arial' font-size='22'%3EInstrumental Store%3C/text%3E%3C/svg%3E";
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

                    @php
                        $imagemProduto = $produto->imagem_principal
                            ? asset('storage/' . $produto->imagem_principal)
                            : $productPlaceholder;
                    @endphp

                    <article class="product-page-card">

                        <img 
                            src="{{ $imagemProduto }}" 
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