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
        <span class="client-separator">></span>
        <span>{{ __('messages.edit_address') }}</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-profile-page">

                <h2>{{ __('messages.edit_address') }}</h2>

                @if ($errors->any())
                    <div class="error-message">
                        <p>Verifique os campos preenchidos.</p>
                    </div>
                @endif

                @php
                    $telefone = $endereco->telefone ?? '';
                    $telefoneNumeros = preg_replace('/\D/', '', $telefone);

                    if (strlen($telefoneNumeros) === 11) {
                        $telefoneFormatado = '(' . substr($telefoneNumeros, 0, 2) . ') ' . substr($telefoneNumeros, 2, 5) . '-' . substr($telefoneNumeros, 7, 4);
                    } elseif (strlen($telefoneNumeros) === 10) {
                        $telefoneFormatado = '(' . substr($telefoneNumeros, 0, 2) . ') ' . substr($telefoneNumeros, 2, 4) . '-' . substr($telefoneNumeros, 6, 4);
                    } else {
                        $telefoneFormatado = $telefone;
                    }

                    $cep = $endereco->cep ?? '';
                    $cepNumeros = preg_replace('/\D/', '', $cep);

                    if (strlen($cepNumeros) === 8) {
                        $cepFormatado = substr($cepNumeros, 0, 5) . '-' . substr($cepNumeros, 5, 3);
                    } else {
                        $cepFormatado = $cep;
                    }
                @endphp

                <form 
                    action="{{ route('cliente.enderecos.update', $endereco->id) }}" 
                    method="POST" 
                    class="client-profile-form"
                >
                    @csrf
                    @method('PUT')

                    <div class="client-form-grid client-form-grid-three">

                        <div class="client-form-group">
                            <label>{{ __('messages.full_name') }}</label>
                            <input 
                                type="text" 
                                name="nome" 
                                value="{{ old('nome', $endereco->nome ?? '') }}"
                            >

                            @error('nome')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.mobile') }}</label>
                            <input 
                                type="text" 
                                name="telefone" 
                                value="{{ old('telefone', $telefoneFormatado) }}"
                                placeholder="(11) 99999-9999"
                            >

                            @error('telefone')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.zip_code') }}</label>
                            <input 
                                type="text" 
                                name="cep" 
                                value="{{ old('cep', $cepFormatado) }}"
                                placeholder="00000-000"
                            >

                            @error('cep')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.street') }}</label>
                            <input 
                                type="text" 
                                name="rua" 
                                value="{{ old('rua', $endereco->rua ?? '') }}"
                            >

                            @error('rua')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.number') }}</label>
                            <input 
                                type="text" 
                                name="numero" 
                                value="{{ old('numero', $endereco->numero ?? '') }}"
                            >

                            @error('numero')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.neighborhood') }}</label>
                            <input 
                                type="text" 
                                name="bairro" 
                                value="{{ old('bairro', $endereco->bairro ?? '') }}"
                            >

                            @error('bairro')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.city') }}</label>
                            <input 
                                type="text" 
                                name="cidade" 
                                value="{{ old('cidade', $endereco->cidade ?? '') }}"
                            >

                            @error('cidade')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.state') }}</label>

                            <select name="estado">
                                <option value="">Selecione</option>

                                <option value="AC" {{ old('estado', $endereco->estado ?? '') == 'AC' ? 'selected' : '' }}>Acre</option>
                                <option value="AL" {{ old('estado', $endereco->estado ?? '') == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                <option value="AP" {{ old('estado', $endereco->estado ?? '') == 'AP' ? 'selected' : '' }}>Amapá</option>
                                <option value="AM" {{ old('estado', $endereco->estado ?? '') == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                <option value="BA" {{ old('estado', $endereco->estado ?? '') == 'BA' ? 'selected' : '' }}>Bahia</option>
                                <option value="CE" {{ old('estado', $endereco->estado ?? '') == 'CE' ? 'selected' : '' }}>Ceará</option>
                                <option value="DF" {{ old('estado', $endereco->estado ?? '') == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                <option value="ES" {{ old('estado', $endereco->estado ?? '') == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                <option value="GO" {{ old('estado', $endereco->estado ?? '') == 'GO' ? 'selected' : '' }}>Goiás</option>
                                <option value="MA" {{ old('estado', $endereco->estado ?? '') == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                <option value="MT" {{ old('estado', $endereco->estado ?? '') == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                <option value="MS" {{ old('estado', $endereco->estado ?? '') == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                <option value="MG" {{ old('estado', $endereco->estado ?? '') == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                <option value="PA" {{ old('estado', $endereco->estado ?? '') == 'PA' ? 'selected' : '' }}>Pará</option>
                                <option value="PB" {{ old('estado', $endereco->estado ?? '') == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                <option value="PR" {{ old('estado', $endereco->estado ?? '') == 'PR' ? 'selected' : '' }}>Paraná</option>
                                <option value="PE" {{ old('estado', $endereco->estado ?? '') == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                <option value="PI" {{ old('estado', $endereco->estado ?? '') == 'PI' ? 'selected' : '' }}>Piauí</option>
                                <option value="RJ" {{ old('estado', $endereco->estado ?? '') == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                <option value="RN" {{ old('estado', $endereco->estado ?? '') == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                <option value="RS" {{ old('estado', $endereco->estado ?? '') == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                <option value="RO" {{ old('estado', $endereco->estado ?? '') == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                <option value="RR" {{ old('estado', $endereco->estado ?? '') == 'RR' ? 'selected' : '' }}>Roraima</option>
                                <option value="SC" {{ old('estado', $endereco->estado ?? '') == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                <option value="SP" {{ old('estado', $endereco->estado ?? '') == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                <option value="SE" {{ old('estado', $endereco->estado ?? '') == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                <option value="TO" {{ old('estado', $endereco->estado ?? '') == 'TO' ? 'selected' : '' }}>Tocantins</option>
                            </select>

                            @error('estado')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>{{ __('messages.complement') }}</label>
                            <input 
                                type="text" 
                                name="complemento" 
                                value="{{ old('complemento', $endereco->complemento ?? '') }}"
                            >

                            @error('complemento')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="client-profile-actions">

                        <a href="{{ route('cliente.enderecos') }}" class="client-btn client-btn-secondary client-btn-link">
                            {{ __('messages.back') }}
                        </a>

                        <button type="submit" class="client-btn client-btn-primary">
                            {{ __('messages.save') }}
                        </button>

                    </div>

                </form>

            </section>

        </main>

    </div>

</div>

@endsection