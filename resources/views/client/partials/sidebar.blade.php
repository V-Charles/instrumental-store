@php
    $usuarioLogado = auth()->user();

    $fotoSidebar = asset('images/default-avatar.png');
    $nomeSidebar = 'Minha conta';

    if ($usuarioLogado) {
        if (!empty($usuarioLogado->foto)) {
            $fotoSidebar = asset('storage/' . $usuarioLogado->foto);
        }
    }
@endphp

<aside class="client-sidebar">

    <div class="client-sidebar-top">

        <div class="client-sidebar-header">

            <div class="client-sidebar-avatar">
                <img src="{{ $fotoSidebar }}" alt="Foto do usuário">
            </div>

            <div class="client-sidebar-welcome">
                <strong>{{ $nomeSidebar }}</strong>
            </div>

        </div>

        <nav class="client-sidebar-nav">

            <a href="/cliente/dados-pessoais" class="client-sidebar-link {{ request()->is('cliente/dados-pessoais') ? 'active' : '' }}">
                <span class="material-symbols-outlined">person</span>
                Dados pessoais
            </a>

            <a href="/cliente/enderecos" class="client-sidebar-link {{ request()->is('cliente/enderecos*') ? 'active' : '' }}">
                <span class="material-symbols-outlined">location_on</span>
                Endereços
            </a>

            <a href="/cliente/pedidos" class="client-sidebar-link {{ request()->is('cliente/pedidos*') ? 'active' : '' }}">
                <span class="material-symbols-outlined">inventory_2</span>
                Pedidos
            </a>

            <a href="/cliente/cartoes" class="client-sidebar-link {{ request()->is('cliente/cartoes*') ? 'active' : '' }}">
                <span class="material-symbols-outlined">credit_card</span>
                Cartões
            </a>

            <a href="/cliente/desejos" class="client-sidebar-link {{ request()->is('cliente/desejos') ? 'active' : '' }}">
                <span class="material-symbols-outlined">favorite</span>
                Desejos
            </a>

            <a href="/cliente/configuracao" class="client-sidebar-link {{ request()->is('cliente/configuracao') ? 'active' : '' }}">
                <span class="material-symbols-outlined">settings</span>
                Configuração
            </a>

        </nav>

    </div>

    <form action="{{ route('logout') }}" method="POST" class="client-sidebar-logout-form">
        @csrf

        <button type="submit" class="client-sidebar-logout">
            <span class="material-symbols-outlined">logout</span>
            Logout
        </button>
    </form>

</aside>