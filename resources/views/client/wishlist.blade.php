@extends('layouts.app')

@section('content')

@php
    $productPlaceholder = asset('images/placeholder-produto.jpg');

    $imagemProdutoUrl = function ($produto) use ($productPlaceholder) {
        if (!$produto || empty($produto->imagem_principal)) {
            return $productPlaceholder;
        }

        if (\Illuminate\Support\Str::startsWith($produto->imagem_principal, ['http://', 'https://'])) {
            return $produto->imagem_principal;
        }

        return asset('storage/' . $produto->imagem_principal);
    };
@endphp

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

                @if (session('success'))
                    <p class="success-message">
                        {{ session('success') }}
                    </p>
                @endif

                <div class="client-wishlist-list">

                    @forelse ($favoritos as $favorito)

                        @php
                            $produto = $favorito->produto;

                            $produtoId = $produto->id ?? '';
                            $nomeProduto = $produto->nome ?? __('messages.product');
                            $descricaoProduto = $produto->descricao ?? '';
                            $precoProduto = $produto->preco ?? null;
                        @endphp

                        <article class="client-wishlist-card">

                            <form 
                                action="{{ route('cliente.favoritos.destroy', $favorito->id) }}" 
                                method="POST"
                                onsubmit="return confirm('Tem certeza que deseja remover este produto dos favoritos?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="client-wishlist-remove">
                                    <span class="material-symbols-outlined">favorite</span>
                                </button>
                            </form>

                            <div class="client-wishlist-image">
                                <img 
                                    src="{{ $imagemProdutoUrl($produto) }}" 
                                    alt="{{ $nomeProduto }}"
                                    onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';">
                            </div>

                            <div class="client-wishlist-info">

                                <h3>{{ $nomeProduto }}</h3>

                                @if ($descricaoProduto)
                                    <p>{{ $descricaoProduto }}</p>
                                @endif

                                @if ($precoProduto)
                                    <p>
                                        R$ {{ number_format($precoProduto, 2, ',', '.') }}
                                    </p>
                                @endif

                                <a href="{{ route('products.show', $produtoId) }}" class="client-wishlist-button">
                                    {{ __('messages.view_product') }}
                                </a>

                            </div>

                        </article>

                    @empty

                        <p class="client-empty-message">
                            {{ __('messages.no_wishlist_items') }}
                        </p>

                    @endforelse

                </div>

            </section>

        </main>

    </div>

</div>

@endsection