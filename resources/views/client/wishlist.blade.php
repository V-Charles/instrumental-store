@extends('layouts.app')

@section('content')

<div class="client-page">

    <input type="checkbox" id="client-menu-toggle">

    <div class="client-breadcrumb-bar">
        <label for="client-menu-toggle" class="client-menu-button">
            <span class="material-symbols-outlined">menu</span>
        </label>

        <span>{{ __('messages.home') }}</span>
        <span class="client-separator">></span>
        <span>{{ __('messages.wishlist') }}</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-wishlist-page">

                <h2>{{ __('messages.wishlist_title') }}</h2>

                <div class="client-wishlist-list">

                    @isset($favoritos)

                        @forelse ($favoritos as $favorito)

                            @php
                                $produto = $favorito->produto ?? $favorito;

                                $produtoId = $produto->id ?? '';
                                $nomeProduto = $produto->nome ?? __('messages.product');
                                $descricaoProduto = $produto->descricao ?? '';
                                $imagemProduto = $produto->imagem_principal ?? null;
                            @endphp

                            <article class="client-wishlist-card">

                                <button type="button" class="client-wishlist-remove">
                                    <span class="material-symbols-outlined">favorite</span>
                                </button>

                                <div class="client-wishlist-image">
                                    <img 
                                        src="{{ $imagemProduto ? asset('storage/' . $imagemProduto) : asset('images/placeholder-produto.jpg') }}" 
                                        alt="{{ $nomeProduto }}">
                                </div>

                                <div class="client-wishlist-info">
                                    <h3>{{ $nomeProduto }}</h3>

                                    @if ($descricaoProduto)
                                        <p>{{ $descricaoProduto }}</p>
                                    @endif

                                    <a href="/produto/{{ $produtoId }}" class="client-wishlist-button">
                                        {{ __('messages.view_product') }}
                                    </a>
                                </div>

                            </article>

                        @empty

                            <p class="client-empty-message">
                                {{ __('messages.no_wishlist_items') }}
                            </p>

                        @endforelse

                    @else

                        <p class="client-empty-message">
                            {{ __('messages.wishlist_backend_message') }}
                        </p>

                    @endisset

                </div>

            </section>

        </main>

    </div>

</div>

@endsection