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
        <span>{{ __('messages.personal_data') }}</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-profile-page">

                <h2>{{ __('messages.personal_data') }}</h2>

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

                @isset($cliente)

                    @php
                        $dataNascimento = '';

                        if (!empty($cliente->data_nascimento)) {
                            try {
                                $dataNascimento = \Carbon\Carbon::parse($cliente->data_nascimento)->format('Y-m-d');
                            } catch (\Exception $e) {
                                $dataNascimento = $cliente->data_nascimento;
                            }
                        }
                    @endphp

                    <form action="{{ route('cliente.dados.atualizar') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="client-form-grid">

                            <div class="client-form-group">
                                <label>{{ __('messages.full_name') }}</label>
                                <input 
                                    type="text" 
                                    name="name"
                                    value="{{ old('name', $cliente->name ?? $cliente->nome ?? $cliente->nome_completo ?? '') }}"
                                >

                                @error('name')
                                    <small class="client-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.birth_date') }}</label>
                                <input 
                                    type="date" 
                                    name="data_nascimento"
                                    value="{{ old('data_nascimento', $dataNascimento) }}"
                                >

                                @error('data_nascimento')
                                    <small class="client-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.cpf') }}</label>
                                <input 
                                    type="text" 
                                    name="cpf"
                                    value="{{ old('cpf', $cliente->cpf ?? '') }}"
                                >

                                @error('cpf')
                                    <small class="client-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.email') }}</label>
                                <input 
                                    type="email" 
                                    name="email"
                                    value="{{ old('email', $cliente->email ?? '') }}"
                                >

                                @error('email')
                                    <small class="client-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.mobile') }}</label>
                                <input 
                                    type="text" 
                                    name="telefone"
                                    value="{{ old('telefone', $cliente->telefone ?? $cliente->celular ?? '') }}"
                                >

                                @error('telefone')
                                    <small class="client-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.gender') }}</label>

                                <select name="sexo">
                                    <option value="">Selecione</option>

                                    <option value="feminino" {{ old('sexo', $cliente->sexo ?? '') == 'feminino' ? 'selected' : '' }}>
                                        Feminino
                                    </option>

                                    <option value="masculino" {{ old('sexo', $cliente->sexo ?? '') == 'masculino' ? 'selected' : '' }}>
                                        Masculino
                                    </option>

                                    <option value="outro" {{ old('sexo', $cliente->sexo ?? '') == 'outro' ? 'selected' : '' }}>
                                        Outro
                                    </option>
                                </select>

                                @error('sexo')
                                    <small class="client-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="client-form-group">
                                <label>Nova senha</label>
                                <input 
                                    type="password" 
                                    name="senha"
                                    placeholder="Preencha apenas se quiser alterar"
                                >

                                @error('senha')
                                    <small class="client-error">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.zip_code') }}</label>
                                <input 
                                    type="text" 
                                    value="{{ $cliente->cep ?? '' }}" 
                                    readonly
                                >
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.street') }}</label>
                                <input 
                                    type="text" 
                                    value="{{ $cliente->rua ?? '' }}" 
                                    readonly
                                >
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.number') }}</label>
                                <input 
                                    type="text" 
                                    value="{{ $cliente->numero ?? '' }}" 
                                    readonly
                                >
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.neighborhood') }}</label>
                                <input 
                                    type="text" 
                                    value="{{ $cliente->bairro ?? '' }}" 
                                    readonly
                                >
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.city') }}</label>
                                <input 
                                    type="text" 
                                    value="{{ $cliente->cidade ?? '' }}" 
                                    readonly
                                >
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.state') }}</label>
                                <input 
                                    type="text" 
                                    value="{{ $cliente->estado ?? '' }}" 
                                    readonly
                                >
                            </div>

                            <div class="client-form-group">
                                <label>{{ __('messages.country') }}</label>
                                <input 
                                    type="text" 
                                    value="{{ $cliente->pais ?? '' }}" 
                                    readonly
                                >
                            </div>

                        </div>

                        <div class="client-profile-actions">
                            <button type="submit" class="client-btn client-btn-primary">
                                Salvar alterações
                            </button>
                        </div>

                    </form>

                @else

                    <p class="client-empty-message">
                        {{ __('messages.personal_data_backend_message') }}
                    </p>

                @endisset

            </section>

        </main>

    </div>

</div>

@endsection