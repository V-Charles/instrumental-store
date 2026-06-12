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
        <span>{{ __('messages.addresses') }}</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-address-page">

                <h2>{{ __('messages.addresses') }}</h2>

                @if (session('success'))
                    <p class="success-message">
                        {{ session('success') }}
                    </p>
                @endif

                <div class="client-address-grid">

                    @forelse ($enderecos as $endereco)

                        @php
                            $cep = $endereco->cep ?? '';
                            $cepNumeros = preg_replace('/\D/', '', $cep);

                            if (strlen($cepNumeros) === 8) {
                                $cepFormatado = substr($cepNumeros, 0, 5) . '-' . substr($cepNumeros, 5, 3);
                            } else {
                                $cepFormatado = $cep;
                            }

                            $telefone = $endereco->telefone ?? '';
                            $telefoneNumeros = preg_replace('/\D/', '', $telefone);

                            if (strlen($telefoneNumeros) === 11) {
                                $telefoneFormatado = '(' . substr($telefoneNumeros, 0, 2) . ') ' . substr($telefoneNumeros, 2, 5) . '-' . substr($telefoneNumeros, 7, 4);
                            } elseif (strlen($telefoneNumeros) === 10) {
                                $telefoneFormatado = '(' . substr($telefoneNumeros, 0, 2) . ') ' . substr($telefoneNumeros, 2, 4) . '-' . substr($telefoneNumeros, 6, 4);
                            } else {
                                $telefoneFormatado = $telefone;
                            }
                        @endphp

                        <article class="client-address-card">

                            <h3>
                                {{ $endereco->nome }}
                            </h3>

                            <p>
                                {{ $endereco->rua }}, {{ $endereco->numero }}

                                @if (!empty($endereco->complemento))
                                    - {{ $endereco->complemento }}
                                @endif

                                <br>

                                {{ $endereco->bairro }}, {{ $endereco->cidade }} - {{ $endereco->estado }}

                                <br>

                                CEP: {{ $cepFormatado }}

                                <br>

                                {{ $telefoneFormatado }}
                            </p>

                            <div class="client-address-actions">

                                <a 
                                    href="{{ route('cliente.enderecos.edit', $endereco->id) }}" 
                                    class="client-address-edit"
                                >
                                    EDITAR
                                </a>

                                <form 
                                    action="{{ route('cliente.enderecos.destroy', $endereco->id) }}" 
                                    method="POST"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este endereço?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="client-address-delete">
                                        <span class="material-symbols-outlined">delete</span>
                                    </button>
                                </form>

                            </div>

                        </article>

                    @empty

                        <p class="client-empty-message">
                            Nenhum endereço cadastrado.
                        </p>

                    @endforelse

                </div>

                <div class="client-address-new">
                    <a href="{{ route('cliente.enderecos.create') }}" class="client-btn client-btn-primary">
                        Cadastrar novo
                    </a>
                </div>

            </section>

        </main>

    </div>

</div>

@endsection