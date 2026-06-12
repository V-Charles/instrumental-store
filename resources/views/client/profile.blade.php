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

                        $fotoCliente = !empty($cliente->foto)
                            ? asset('storage/' . $cliente->foto)
                            : asset('images/default-avatar.png');

                        $telefone = $cliente->telefone ?? $cliente->celular ?? '';
                        $telefoneNumeros = preg_replace('/\D/', '', $telefone);

                        if (strlen($telefoneNumeros) === 11) {
                            $telefoneFormatado = '(' . substr($telefoneNumeros, 0, 2) . ') ' . substr($telefoneNumeros, 2, 5) . '-' . substr($telefoneNumeros, 7, 4);
                        } elseif (strlen($telefoneNumeros) === 10) {
                            $telefoneFormatado = '(' . substr($telefoneNumeros, 0, 2) . ') ' . substr($telefoneNumeros, 2, 4) . '-' . substr($telefoneNumeros, 6, 4);
                        } else {
                            $telefoneFormatado = $telefone;
                        }

                        $cpf = $cliente->cpf ?? '';
                        $cpfNumeros = preg_replace('/\D/', '', $cpf);

                        if (strlen($cpfNumeros) === 11) {
                            $cpfFormatado = substr($cpfNumeros, 0, 3) . '.' .
                                            substr($cpfNumeros, 3, 3) . '.' .
                                            substr($cpfNumeros, 6, 3) . '-' .
                                            substr($cpfNumeros, 9, 2);
                        } else {
                            $cpfFormatado = $cpf;
                        }
                    @endphp

                    <form action="{{ route('cliente.dados.atualizar') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="client-photo-area">

                            <div class="client-photo-preview">
                                <img src="{{ $fotoCliente }}" alt="Foto do cliente">
                            </div>

                            <div class="client-photo-field">
                                <label>Foto de perfil</label>

                                <input 
                                    type="file" 
                                    name="foto"
                                    accept="image/png, image/jpeg, image/jpg, image/webp"
                                >

                                <small>
                                    Formatos aceitos: JPG, PNG ou WEBP. Tamanho máximo: 2MB.
                                </small>

                                @error('foto')
                                    <small class="client-error">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>

                        <div class="client-form-grid client-form-grid-two">

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
                                    value="{{ old('cpf', $cpfFormatado) }}"
                                    placeholder="000.000.000-00"
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
                                    value="{{ old('telefone', $telefoneFormatado) }}"
                                    placeholder="(11) 99999-9999"
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