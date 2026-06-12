<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumental Store</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0..1,0" />
    
    <link rel="stylesheet" href="{{ asset('css/cabecalho.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/client.css') }}">
</head>

<body>

    @php
        $cartItems = session('cart', []);
        $cartTotal = 0;
        $cartCount = 0;

        foreach ($cartItems as $item) {
            $itemQuantity = $item['quantidade'] ?? 1;
            $itemPrice = $item['preco'] ?? 0;

            $cartCount += $itemQuantity;
            $cartTotal += $itemPrice * $itemQuantity;
        }

        $favoritosCount = auth()->check() ? \App\Models\Favorito::where('user_id', auth()->id())->count() : 0;

    @endphp

    <header class="main-header">
        <input type="checkbox" id="mobile-menu-toggle" class="mobile-menu-toggle">

        <div class="header-container">
            <div class="logo">
                <a href="/">
                    <img src="{{ asset('images/Logotipo_Instrumental-Store2.svg') }}" alt="Instrumental Store" class="client-logo">
                </a>
            </div>

            <nav class="nav-links">
                <ul>
                    <li>
                        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">
                            {{ __('messages.home') }}
                        </a>
                    </li>

                    <li>
                        <a href="/produtos" class="{{ request()->is('produtos*') ? 'active' : '' }}">
                            {{ __('messages.products') }}
                        </a>
                    </li>

                    <li>
                        <a href="/sobre" class="{{ request()->is('sobre') ? 'active' : '' }}">
                            {{ __('messages.about') }}
                        </a>
                    </li>

                    <li class="mobile-only-link">
                        <a href="{{ route('cliente.favoritos') }}" class="{{ request()->routeIs('cliente.favoritos') ? 'active' : '' }}">
                            {{ __('messages.favorites') }}
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="header-actions">
                <div class="user-greeting-wrapper">
                    @auth
                        <span class="user-greeting-text">
                            Olá, {{ explode(' ', Auth::user()->name)[0] }}!
                        </span>
                        <a href="{{ route('cliente.dados') }}" title="Minha Conta" class="user-greeting-link">
                            <span class="material-symbols-outlined">person</span>
                        </a>
                    @else
                        <span class="user-greeting-text">
                            Olá, Visitante!
                        </span>
                        <a href="/login" title="Fazer Login" class="user-greeting-link">
                            <span class="material-symbols-outlined">person_alert</span>
                        </a>
                    @endauth
                </div>
                
                <div class="search-container fixed-search">
                    <input type="text" class="desktop-search-input" placeholder="{{ __('messages.search_placeholder') ?? 'O que você procura?' }}">
                    <button class="icon-btn" title="Buscar">
                        <span class="material-symbols-outlined">search</span>
                    </button>
                </div>

                <a href="{{ route('lang.switch', app()->getLocale() === 'pt' ? 'en' : 'pt') }}" title="Idioma">
                    <span class="material-symbols-outlined">language</span>
                </a>
                
                <a href="{{ route('cliente.favoritos') }}" class="desktop-favorites" title="Favoritos" style="position: relative;">
                    <span class="material-symbols-outlined">favorite</span>
                    @if ($favoritosCount > 0)
                        <span style="position: absolute; top: -5px; right: -8px; background-color: #b0003a; color: white; border-radius: 50%; padding: 2px 5px; font-size: 10px; font-weight: bold;">
                            {{ $favoritosCount }}
                        </span>
                    @endif
                </a>
                
                <div class="mini-cart-wrapper">

                    <button type="button" class="mini-cart-button" id="miniCartButton" title="Carrinho">
                        <span class="material-symbols-outlined">shopping_cart</span>

                        @if ($cartCount > 0)
                            <span class="mini-cart-count">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </button>

                    <div class="mini-cart-box" id="miniCartBox">

                        <div class="mini-cart-header">
                            <h3>Carrinho</h3>

                            <button type="button" id="closeMiniCart" aria-label="Fechar carrinho">
                                ×
                            </button>
                        </div>

                        @if (count($cartItems) > 0)

                            <div class="mini-cart-items">

                                @foreach ($cartItems as $item)

                                    @php
                                        $itemName = $item['nome'] ?? 'Produto';
                                        $itemPrice = $item['preco'] ?? 0;
                                        $itemQuantity = $item['quantidade'] ?? 1;
                                        $itemImage = $item['imagem'] ?? null;
                                        $itemSubtotal = $itemPrice * $itemQuantity;
                                    @endphp

                                    <div class="mini-cart-item">

                                        <div class="mini-cart-image">
                                            @if ($itemImage)
                                                <img src="{{ asset('storage/' . $itemImage) }}" alt="{{ $itemName }}">
                                            @else
                                                <div class="mini-cart-placeholder">
                                                    IS
                                                </div>
                                            @endif
                                        </div>

                                        <div class="mini-cart-info">
                                            <h4>{{ $itemName }}</h4>

                                            <p>
                                                Quantidade: {{ $itemQuantity }}
                                            </p>

                                            <strong>
                                                R$ {{ number_format($itemSubtotal, 2, ',', '.') }}
                                            </strong>
                                        </div>

                                    </div>

                                @endforeach

                            </div>

                            <div class="mini-cart-footer">

                                <div class="mini-cart-total">
                                    <span>Total</span>

                                    <strong>
                                        R$ {{ number_format($cartTotal, 2, ',', '.') }}
                                    </strong>
                                </div>

                                <a href="/carrinho" class="mini-cart-view">
                                    Ver carrinho
                                </a>

                            </div>

                        @else

                            <div class="mini-cart-empty">
                                <p>Seu carrinho está vazio.</p>
                            </div>

                        @endif

                    </div>

                </div>

                <label for="mobile-menu-toggle" class="hamburger-icon">
                    <span class="material-symbols-outlined">menu</span>
                </label>
            </div>
        </div>

        <div class="mobile-search-bar">
            <span class="material-symbols-outlined">search</span>
            <input type="text" placeholder="{{ __('messages.search_placeholder') }}">
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <section class="site-footer-top">
            <div class="site-footer-top-item">
                <span class="material-symbols-outlined">workspace_premium</span>

                <div>
                    <h3>{{ __('messages.quality') }}</h3>
                    <p>{{ __('messages.quality_text') }}</p>
                </div>
            </div>

            <div class="site-footer-top-item">
                <span class="material-symbols-outlined">verified</span>

                <div>
                    <h3>{{ __('messages.warranty') }}</h3>
                    <p>{{ __('messages.warranty_text') }}</p>
                </div>
            </div>

            <div class="site-footer-top-item">
                <span class="material-symbols-outlined">local_shipping</span>

                <div>
                    <h3>{{ __('messages.free_shipping') }}</h3>
                    <p>{{ __('messages.free_shipping_text') }}</p>
                </div>
            </div>
        </section>

        <section class="site-footer-main">
            <div class="site-footer-column">
                <h4>{{ __('messages.category') }}</h4>

                <ul>
                    <li>{{ __('messages.accessories') }}</li>
                    <li>{{ __('messages.strings') }}</li>
                    <li>{{ __('messages.amplifiers') }}</li>
                    <li>{{ __('messages.pedals') }}</li>
                    <li>{{ __('messages.keys') }}</li>
                    <li>{{ __('messages.percussion') }}</li>
                    <li>{{ __('messages.wind') }}</li>
                    <li>{{ __('messages.audio_tech') }}</li>
                </ul>
            </div>

            <div class="site-footer-column">
                <h4>{{ __('messages.service') }}</h4>

                <ul>
                    <li>(11) 1234-5678</li>
                    <li>(11) 8765-4321</li>
                    <li>(11) 9234-5678</li>
                    <li>instrumentalstore@ficticio.com</li>
                </ul>
            </div>

            <div class="site-footer-column">
                <h4>{{ __('messages.payment_methods') }}</h4>

                <ul>
                    <li>{{ __('messages.credit_card') }}</li>
                    <li>{{ __('messages.debit_card') }}</li>
                    <li>{{ __('messages.pix') }}</li>
                </ul>
            </div>
        </section>

        <div class="site-footer-divider"></div>

        <section class="site-footer-bottom">
            <p>{{ __('messages.rights') }}</p>
        </section>
    </footer>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>