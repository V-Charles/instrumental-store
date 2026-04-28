<!DOCTYPE html>
<html lang="pt-br">
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
                    <img src="{{ asset('images/logotipo_Instrumental-Store2.svg') }}" alt="Logo Instrumental Store" class="admin-logo">
                </a>
            </div>
        </div>
        <div class="admin-header-actions">
            <a href="/" title="Acessar o Site Público" target="_blank">
                <span class="material-symbols-outlined">language</span>
            </a>
            <a href="/admin/logout" class="logout-btn">
                <span class="material-symbols-outlined">logout</span>
                Logout
            </a>
        </div>
    </header>
    <div class="admin-breadcrumb-bar">
        <label for="menu-toggle" class="hamburger-label" title="Abrir Menu">
            <span class="material-symbols-outlined">menu</span>
        </label>
        INICIO <span class="separator">></span> 
        <span class="vertical-line"></span> 
        @yield('breadcrumb', 'PAINEL ADMINISTRATIVO')
    </div>
    <div class="admin-main-container">
        
        <aside class="admin-sidebar">
            
            <div class="admin-user-profile">
                <img src="{{ asset('images/default-avatar.png') }}" alt="Foto do Usuário" class="user-avatar">
                <div class="user-name">João Santos</div>
            </div>
            <nav class="admin-nav">
                <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">desktop_windows</span>
                    PAINEL CENTRAL
                </a>
                <a href="/admin/produtos" class="{{ request()->is('admin/produtos*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    PRODUTOS
                </a>
                <a href="/admin/estoque" class="{{ request()->is('admin/estoque*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">warehouse</span>
                    ESTOQUE
                </a>
                <a href="/admin/pedidos" class="{{ request()->is('admin/pedidos*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">package</span>
                    PEDIDOS
                </a>
                <a href="/admin/pagamentos" class="{{ request()->is('admin/pagamentos*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">account_balance_wallet</span>
                    PAGAMENTOS
                </a>
                <a href="/admin/devolucoes" class="{{ request()->is('admin/devolucoes*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">sync_alt</span>
                    DEVOLUÇÕES
                </a>
                <a href="/admin/clientes" class="{{ request()->is('admin/clientes*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">person</span>
                    CLIENTES
                </a>
                <a href="/admin/equipe" class="{{ request()->is('admin/equipe*') ? 'active' : '' }}">
                    <span class="material-symbols-outlined">group</span>
                    EQUIPE
                </a>
            </nav>
        </aside>
        <main class="admin-content">
            @yield('content')
        </main>
    </div>
</body>
</html>