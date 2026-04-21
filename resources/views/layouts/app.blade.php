<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumental Store</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <link rel="stylesheet" href="{{ asset('css/cabecalho.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo">
                <a href="/">
                    <h2>Instrumental</h2>
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
                </ul>
            </nav>

            <div class="header-actions">
                <a href="{{ route('lang.switch', app()->getLocale() === 'pt' ? 'en' : 'pt') }}" title="Idioma">
                    <span class="material-symbols-outlined">language</span>
                </a>
                <a href="/login" title="Minha Conta"><span class="material-symbols-outlined">person_alert</span></a>
                <button class="icon-btn" title="Buscar"><span class="material-symbols-outlined">search</span></button>
                <a href="/favoritos" title="Favoritos"><span class="material-symbols-outlined">favorite</span></a>
                <a href="/carrinho" title="Carrinho"><span class="material-symbols-outlined">shopping_cart</span></a>
            </div>
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