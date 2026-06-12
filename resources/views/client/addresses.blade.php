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
        <span>Cadastrar novo endereço</span>
    </div>

    <div class="client-main-container">

        @include('client.partials.sidebar')

        <main class="client-content">

            <section class="client-profile-page">

                <h2>Cadastrar novo endereço</h2>

                @if ($errors->any())
                    <div class="error-message">
                        <p>Verifique os campos preenchidos.</p>
                    </div>
                @endif

                <form action="{{ route('cliente.enderecos.store') }}" method="POST">
                    @csrf

                    <div class="client-form-grid client-form-grid-three">

                        <div class="client-form-group">
                            <label>Nome Completo</label>
                            <input 
                                type="text" 
                                name="nome"
                                value="{{ old('nome', auth()->user()->name ?? '') }}"
                            >

                            @error('nome')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>Celular</label>
                            <input 
                                type="text" 
                                name="telefone"
                                value="{{ old('telefone') }}"
                                placeholder="(11) 99999-9999"
                            >

                            @error('telefone')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>CEP</label>
                            <input 
                                type="text" 
                                name="cep"
                                value="{{ old('cep') }}"
                                placeholder="00000-000"
                            >

                            @error('cep')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>Rua</label>
                            <input 
                                type="text" 
                                name="rua"
                                value="{{ old('rua') }}"
                            >

                            @error('rua')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>Número</label>
                            <input 
                                type="text" 
                                name="numero"
                                value="{{ old('numero') }}"
                            >

                            @error('numero')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>Bairro</label>
                            <input 
                                type="text" 
                                name="bairro"
                                value="{{ old('bairro') }}"
                            >

                            @error('bairro')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>Cidade</label>
                            <input 
                                type="text" 
                                name="cidade"
                                value="{{ old('cidade') }}"
                            >

                            @error('cidade')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>Estado</label>

                            <select name="estado">
                                <option value="">Selecione</option>
                                <option value="AC" {{ old('estado') == 'AC' ? 'selected' : '' }}>Acre</option>
                                <option value="AL" {{ old('estado') == 'AL' ? 'selected' : '' }}>Alagoas</option>
                                <option value="AP" {{ old('estado') == 'AP' ? 'selected' : '' }}>Amapá</option>
                                <option value="AM" {{ old('estado') == 'AM' ? 'selected' : '' }}>Amazonas</option>
                                <option value="BA" {{ old('estado') == 'BA' ? 'selected' : '' }}>Bahia</option>
                                <option value="CE" {{ old('estado') == 'CE' ? 'selected' : '' }}>Ceará</option>
                                <option value="DF" {{ old('estado') == 'DF' ? 'selected' : '' }}>Distrito Federal</option>
                                <option value="ES" {{ old('estado') == 'ES' ? 'selected' : '' }}>Espírito Santo</option>
                                <option value="GO" {{ old('estado') == 'GO' ? 'selected' : '' }}>Goiás</option>
                                <option value="MA" {{ old('estado') == 'MA' ? 'selected' : '' }}>Maranhão</option>
                                <option value="MT" {{ old('estado') == 'MT' ? 'selected' : '' }}>Mato Grosso</option>
                                <option value="MS" {{ old('estado') == 'MS' ? 'selected' : '' }}>Mato Grosso do Sul</option>
                                <option value="MG" {{ old('estado') == 'MG' ? 'selected' : '' }}>Minas Gerais</option>
                                <option value="PA" {{ old('estado') == 'PA' ? 'selected' : '' }}>Pará</option>
                                <option value="PB" {{ old('estado') == 'PB' ? 'selected' : '' }}>Paraíba</option>
                                <option value="PR" {{ old('estado') == 'PR' ? 'selected' : '' }}>Paraná</option>
                                <option value="PE" {{ old('estado') == 'PE' ? 'selected' : '' }}>Pernambuco</option>
                                <option value="PI" {{ old('estado') == 'PI' ? 'selected' : '' }}>Piauí</option>
                                <option value="RJ" {{ old('estado') == 'RJ' ? 'selected' : '' }}>Rio de Janeiro</option>
                                <option value="RN" {{ old('estado') == 'RN' ? 'selected' : '' }}>Rio Grande do Norte</option>
                                <option value="RS" {{ old('estado') == 'RS' ? 'selected' : '' }}>Rio Grande do Sul</option>
                                <option value="RO" {{ old('estado') == 'RO' ? 'selected' : '' }}>Rondônia</option>
                                <option value="RR" {{ old('estado') == 'RR' ? 'selected' : '' }}>Roraima</option>
                                <option value="SC" {{ old('estado') == 'SC' ? 'selected' : '' }}>Santa Catarina</option>
                                <option value="SP" {{ old('estado') == 'SP' ? 'selected' : '' }}>São Paulo</option>
                                <option value="SE" {{ old('estado') == 'SE' ? 'selected' : '' }}>Sergipe</option>
                                <option value="TO" {{ old('estado') == 'TO' ? 'selected' : '' }}>Tocantins</option>
                            </select>

                            @error('estado')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="client-form-group">
                            <label>Complemento</label>
                            <input 
                                type="text" 
                                name="complemento"
                                value="{{ old('complemento') }}"
                                placeholder="Casa, apartamento, bloco..."
                            >

                            @error('complemento')
                                <small class="client-error">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="client-profile-actions">
                        <a href="{{ route('cliente.enderecos') }}" class="client-btn client-btn-secondary">
                            Voltar
                        </a>

                        <button type="submit" class="client-btn client-btn-primary">
                            Salvar
                        </button>
                    </div>

                </form>

            </section>

        </main>

    </div>

</div>

@endsection