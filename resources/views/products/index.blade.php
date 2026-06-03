@extends('layouts.app')

@section('content')

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
                <select name="categoria" class="products-category-input">
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
                            src="{{ $produto->imagem_principal ? asset('storage/' . $produto->imagem_principal) : asset('images/placeholder-produto.jpg') }}" 
                            alt="{{ $produto->nome }}">

                        <div class="product-page-info">
                            <p class="product-page-brand">
                                {{ $produto->marca ?? '' }}
                            </p>

                            <h3>
                                {{ $produto->nome }}
                            </h3>

                            <p class="product-page-price">
                                R$ {{ number_format($produto->preco, 2, ',', '.') }}
                            </p>

                            <div class="product-page-actions">
                                <a href="{{ route('cart') }}" class="home-btn home-btn--primary">
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
            <div class="products-pagination">
                {{ $produtos->links() }}
            </div>
        @endisset

    </section>

</div>

@endsection