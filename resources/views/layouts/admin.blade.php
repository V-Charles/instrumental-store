<!DOCTYPE html>
<html lang="{{ session('locale', 'pt') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Instrumental Store</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-body">

    <input type="checkbox" id="menu-toggle">

    <header class="admin-header">
        <div class="header-left">
            <div class="admin-logo-container">
                <a href="/admin/dashboard">
                    <img src="{{ asset('images/Logotipo_Instrumental-Store2.svg') }}" alt="Logo Instrumental Store" class="admin-logo">
                </a>
            </div>
        </div>
        
        <div class="admin-header-actions">
            <a href="/" title="Acessar o Site Público" target="_blank" class="vitrine-link">
                <span class="material-symbols-outlined">storefront</span>
            </a>

            @php
                $idiomaAtual = session('locale', 'pt');
                $proximoIdioma = $idiomaAtual === 'pt' ? 'en' : 'pt';
            @endphp
            <a href="{{ route('lang.switch', $proximoIdioma) }}" class="lang-toggle" title="Mudar idioma">
                <span class="material-symbols-outlined">language</span>
            </a>

            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn" style="cursor: pointer;">
                <span class="material-symbols-outlined">logout</span>{{ __('messages.logout') }}
            </a>
        </div>
    </header>

    <div class="admin-breadcrumb-bar">
        <label for="menu-toggle" class="hamburger-label" title="Abrir Menu">
            <span class="material-symbols-outlined">menu</span>
        </label>
        {{ __('messages.admin_home') }} <span class="separator">></span> 
        <span class="vertical-line"></span> 
        @yield('breadcrumb', __('messages.admin_panel'))
    </div>

    <div class="admin-main-container">
        
        <aside class="admin-sidebar">
            <div class="admin-user-profile">
                @if(auth()->check() && auth()->user()->foto)
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto do Usuário" class="user-avatar" style="object-fit: cover;">
                @else
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Foto do Usuário" class="user-avatar">
                @endif
                
                <div class="user-name">{{ auth()->check() ? auth()->user()->name : 'Usuário' }}</div>
                
                @if(auth()->check() && auth()->user()->cargo)
                    <div style="font-size: 12px; color: #888; text-transform: capitalize; margin-top: 4px;">
                        {{ __('messages.role_' . strtolower(auth()->user()->cargo)) }}
                    </div>
                @endif
            </div>
            <nav class="admin-nav">
                <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">desktop_windows</span>
                    {{ __('messages.dashboard') }}
                </a>
                <a href="/admin/produtos" class="{{ request()->is('admin/produtos*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    {{ __('messages.admin_products') }}
                </a>
                <a href="/admin/pedidos" class="{{ request()->is('admin/pedidos*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">package</span>
                    {{ __('messages.admin_orders') }}
                </a>
                <a href="/admin/pagamentos" class="{{ request()->is('admin/pagamentos*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">account_balance_wallet</span>
                    {{ __('messages.payments') }}
                </a>
                <a href="/admin/devolucoes" class="{{ request()->is('admin/devolucoes*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">sync_alt</span>
                    {{ __('messages.returns') }}
                </a>
                <a href="/admin/clientes" class="{{ request()->is('admin/clientes*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">person</span>
                    {{ __('messages.clients') }}
                </a>
                <a href="/admin/funcionarios" class="{{ request()->is('admin/funcionarios*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">group</span>
                    {{ __('messages.team') }}
                </a>
            </nav>
        </aside>

        <main class="admin-content">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/mascara.js') }}"></script>
    <script src="{{ asset('js/upload-imagens.js') }}"></script>
</body>
</html>