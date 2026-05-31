<aside class="client-sidebar">

    <div class="client-user-profile">
        <img 
            src="{{ asset('images/default-avatar.png') }}" 
            alt="{{ __('messages.client_photo') }}" 
            class="client-user-avatar">

        <div class="client-user-name">
            {{ __('messages.client_greeting') }}
        </div>
    </div>

    <nav class="client-nav">

        <a href="/cliente/dados-pessoais" class="{{ request()->is('cliente/dados-pessoais') ? 'active' : '' }}">
            <span class="material-symbols-outlined">person</span>
            {{ __('messages.personal_data') }}
        </a>

        <a href="/cliente/enderecos" class="{{ request()->is('cliente/enderecos') ? 'active' : '' }}">
            <span class="material-symbols-outlined">location_on</span>
            {{ __('messages.addresses') }}
        </a>

        <a href="/cliente/pedidos" class="{{ request()->is('cliente/pedidos') ? 'active' : '' }}">
            <span class="material-symbols-outlined">inventory_2</span>
            {{ __('messages.orders') }}
        </a>

        <a href="/cliente/cartoes" class="{{ request()->is('cliente/cartoes') ? 'active' : '' }}">
            <span class="material-symbols-outlined">credit_card</span>
            {{ __('messages.cards') }}
        </a>

        <a href="/cliente/desejos" class="{{ request()->is('cliente/desejos') ? 'active' : '' }}">
            <span class="material-symbols-outlined">favorite</span>
            {{ __('messages.wishlist') }}
        </a>

        <a href="/cliente/configuracao" class="{{ request()->is('cliente/configuracao') ? 'active' : '' }}">
            <span class="material-symbols-outlined">settings</span>
            {{ __('messages.configuration') }}
        </a>

    </nav>

    <div class="client-logout">
        <a href="#">
            <span class="material-symbols-outlined">logout</span>
            {{ __('messages.logout') }}
        </a>
    </div>

</aside>