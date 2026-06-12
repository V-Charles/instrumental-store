@extends('layouts.app')

@section('content')

@php
    $idiomaAtual = session('locale', 'pt');

    if ($idiomaAtual === 'en') {
        $idiomaAtualTexto = 'Inglês';
    } else {
        $idiomaAtualTexto = 'Português';
    }
@endphp

<div class="client-page">

    <input type="checkbox" id="client-menu-toggle">

    <div class="client-breadcrumb-bar">
        <label for="client-menu-toggle" class="client-menu-button">
            <span class="material-symbols-outlined">menu</span>
        </label>

        <span>{{ __('messages.home') }}</span>
        <span class="client-separator">></span>
        <span>{{ __('messages.account_settings') }}</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-profile-page">

                <h2>{{ __('messages.account_settings') }}</h2>

                @if (session('success'))
                    <p class="success-message">
                        {{ session('success') }}
                    </p>
                @endif

                @if ($errors->any())
                    <div class="error-message">
                        <p>Verifique os campos preenchidos.</p>
                    </div>
                @endif

                <div class="client-settings-area">

                    <!-- ALTERAR SENHA -->
                    <div class="client-settings-card">

                        <input type="checkbox" id="show-password-form" class="client-settings-toggle">

                        <h3>Alterar senha</h3>

                        <p>
                            Altere sua senha de acesso informando a senha atual e cadastrando uma nova senha.
                        </p>

                        <label for="show-password-form" class="client-btn client-btn-primary client-settings-open-button">
                            Alterar senha
                        </label>

                        <form action="{{ route('cliente.configuracao.senha') }}" method="POST" class="client-settings-hidden-area">
                            @csrf
                            @method('PUT')

                            <div class="client-form-grid">

                                <div class="client-form-group">
                                    <label>Senha atual</label>
                                    <input 
                                        type="password" 
                                        name="senha_atual"
                                        placeholder="Digite sua senha atual"
                                    >

                                    @error('senha_atual')
                                        <small class="client-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="client-form-group">
                                    <label>Nova senha</label>
                                    <input 
                                        type="password" 
                                        name="nova_senha"
                                        placeholder="Digite a nova senha"
                                    >

                                    @error('nova_senha')
                                        <small class="client-error">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="client-form-group">
                                    <label>Confirmar nova senha</label>
                                    <input 
                                        type="password" 
                                        name="nova_senha_confirmation"
                                        placeholder="Confirme a nova senha"
                                    >
                                </div>

                            </div>

                            <div class="client-profile-actions">
                                <button type="submit" class="client-btn client-btn-primary">
                                    Salvar nova senha
                                </button>
                            </div>
                        </form>

                    </div>

                    <!-- IDIOMA -->
                    <div class="client-settings-card">

                        <input type="checkbox" id="show-language-form" class="client-settings-toggle">

                        <h3>Idioma da conta</h3>

                        <p>
                            Idioma atual: <strong>{{ $idiomaAtualTexto }}</strong>
                        </p>

                        <label for="show-language-form" class="client-btn client-btn-primary client-settings-open-button">
                            Alterar idioma
                        </label>

                        <form action="{{ route('cliente.configuracao.idioma') }}" method="POST" class="client-settings-hidden-area">
                            @csrf
                            @method('PUT')

                            <div class="client-form-grid">

                                <div class="client-form-group">
                                    <label>Escolha o idioma</label>

                                    <select name="idioma">
                                        <option value="pt" {{ $idiomaAtual === 'pt' ? 'selected' : '' }}>
                                            Português
                                        </option>

                                        <option value="en" {{ $idiomaAtual === 'en' ? 'selected' : '' }}>
                                            Inglês
                                        </option>
                                    </select>

                                    @error('idioma')
                                        <small class="client-error">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="client-profile-actions">
                                <button type="submit" class="client-btn client-btn-primary">
                                    Salvar idioma
                                </button>
                            </div>
                        </form>

                    </div>

                    <!-- EXCLUIR CONTA -->
                    <div class="client-settings-card client-danger-card">

                        <input type="checkbox" id="show-delete-form" class="client-settings-toggle">

                        <h3>Excluir conta</h3>

                        <p>
                            Ao excluir sua conta, seus dados de acesso serão removidos.
                            Pedidos antigos podem continuar registrados para controle da loja.
                        </p>

                        <label for="show-delete-form" class="client-btn client-btn-danger client-settings-open-button">
                            Excluir conta
                        </label>

                        <form action="{{ route('cliente.configuracao.excluir') }}" method="POST" class="client-settings-hidden-area">
                            @csrf
                            @method('DELETE')

                            <div class="client-form-grid">

                                <div class="client-form-group">
                                    <label>Confirme sua senha</label>
                                    <input 
                                        type="password" 
                                        name="senha_exclusao"
                                        placeholder="Digite sua senha para confirmar"
                                    >

                                    @error('senha_exclusao')
                                        <small class="client-error">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="client-profile-actions">
                                <button 
                                    type="submit" 
                                    class="client-btn client-btn-danger"
                                    onclick="return confirm('Tem certeza que deseja excluir sua conta? Essa ação não poderá ser desfeita.')"
                                >
                                    Confirmar exclusão
                                </button>
                            </div>
                        </form>

                    </div>

                </div>

            </section>

        </main>

    </div>

</div>

@endsection