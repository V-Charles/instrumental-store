<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrumental Store</title>
    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    
    <link rel="stylesheet" href="{{ asset('css/cabecalho.css') }}">
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
                        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Inicio</a>
                    </li>
                    <li>
                        <a href="/produtos" class="{{ request()->is('produtos*') ? 'active' : '' }}">Produtos</a>
                    </li>
                    <li>
                        <a href="/sobre" class="{{ request()->is('sobre') ? 'active' : '' }}">Sobre</a>
                    </li>
                </ul>
            </nav>
            <div class="header-actions">
                <a href="/idioma" title="Idioma"><span class="material-symbols-outlined">language</span></a>
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

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>