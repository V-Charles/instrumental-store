@extends('layouts.admin')

@section('breadcrumb', isset($produto) ? __('messages.edit_product_upper') : __('messages.add_product_upper'))

@section('content')

@php
    $productPlaceholder = asset('images/placeholder-produto.jpg');

    $imagemProdutoUrl = function ($imagem) use ($productPlaceholder) {
        if (empty($imagem)) {
            return $productPlaceholder;
        }

        if (\Illuminate\Support\Str::startsWith($imagem, ['http://', 'https://'])) {
            return $imagem;
        }

        return asset('storage/' . $imagem);
    };
@endphp

<div class="admin-page-header">
    <h2>{{ isset($produto) ? __('messages.edit_product') : __('messages.add_new_product') }}</h2>
</div>

<form action="{{ isset($produto) ? '/admin/produtos/' . $produto->id : '/admin/produtos' }}" method="POST" enctype="multipart/form-data" class="product-create-form">
    @csrf
    @if(isset($produto))
        @method('PUT')
    @endif
    
    <div class="form-layout-grid">
        <div class="form-left-column">
            <div class="form-card">
                <h3>{{ __('messages.basic_details') }}</h3>
                
                <div class="form-group">
                    <label for="nome">{{ __('messages.product_name') }}</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $produto->nome ?? '') }}" placeholder="{{ __('messages.placeholder_product_name') }}" required>
                </div>

                <div class="form-group">
                    <label for="marca">{{ __('messages.product_brand') }}</label>
                    <input type="text" id="marca" name="marca" value="{{ old('marca', $produto->marca ?? '') }}" placeholder="{{ __('messages.placeholder_product_brand') }}" required>
                </div>

                <div class="form-group">
                    <label for="descricao">{{ __('messages.product_description') }}</label>
                    <textarea id="descricao" name="descricao" rows="5" placeholder="{{ __('messages.placeholder_product_description') }}" required>{{ old('descricao', $produto->descricao ?? '') }}</textarea>
                </div>
            </div>

            <div class="form-card">
                <h3>{{ __('messages.pricing') }}</h3>
                
                <div class="form-group">
                    <label for="preco">{{ __('messages.product_price') }}</label>
                    <div class="input-with-prefix">
                        <span class="prefix">R$</span>
                        <input type="text" id="preco" name="preco" value="{{ old('preco', isset($produto) ? number_format($produto->preco, 2, ',', '.') : '') }}" placeholder="0,00" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="desconto">{{ __('messages.product_discount') }} <span class="optional">({{ __('messages.optional') }})</span></label>
                        <div class="input-with-prefix">
                            <span class="prefix">R$</span>
                            <input type="text" id="desconto" name="desconto" value="{{ old('desconto', (isset($produto) && $produto->desconto) ? number_format($produto->desconto, 2, ',', '.') : '') }}" placeholder="0,00">
                        </div>
                    </div>
                    <div class="form-group half-width align-bottom">
                        <div class="calculated-price">
                            {{ __('messages.sold_status') }} = R$ <span id="preco-final">{{ isset($produto) ? number_format(($produto->preco - ($produto->desconto ?? 0)), 2, ',', '.') : '0,00' }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="data_inicio">{{ __('messages.expiration_start') }}</label>
                        <input type="date" id="data_inicio" name="data_inicio" value="{{ old('data_inicio', $produto->data_inicio ?? '') }}">
                    </div>
                    <div class="form-group half-width">
                        <label for="data_fim">{{ __('messages.expiration_end') }}</label>
                        <input type="date" id="data_fim" name="data_fim" value="{{ old('data_fim', $produto->data_fim ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="form-card">
                <h3>{{ __('messages.inventory') }}</h3>
                
                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="quantidade">{{ __('messages.stock_quantity') }}</label>
                        <input type="number" id="quantidade" name="quantidade" value="{{ old('quantidade', $produto->quantidade ?? '') }}" min="0" placeholder="0" required>
                    </div>
                    <div class="form-group half-width">
                        <label for="status">{{ __('messages.stock_status') }}</label>
                        <select id="status" name="status" required>
                            <option value="em_estoque" {{ (old('status', $produto->status ?? '') == 'em_estoque') ? 'selected' : '' }}>{{ __('messages.in_stock') }}</option>
                            <option value="fora_de_estoque" {{ (old('status', $produto->status ?? '') == 'fora_de_estoque') ? 'selected' : '' }}>{{ __('messages.out_of_stock') }}</option>
                            <option value="sob_encomenda" {{ (old('status', $produto->status ?? '') == 'sob_encomenda') ? 'selected' : '' }}>{{ __('messages.on_demand') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-right-column">
            <div class="form-card">
                <h3>{{ __('messages.media_upload_title') }}</h3>
                
                <div class="image-upload-area">
                    <input type="file" id="imagem_principal" name="imagem_principal" accept="image/*" {{ isset($produto) ? '' : 'required' }}>
                    <div class="upload-placeholder">
                        @if(isset($produto) && $produto->imagem_principal)
                            <img 
                                src="{{ $imagemProdutoUrl($produto->imagem_principal) }}" 
                                onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';"
                                style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;"
                            >
                        @else
                            <span class="material-symbols-outlined">add_photo_alternate</span>
                            <p>{{ __('messages.media_upload_placeholder') }}</p>
                        @endif
                    </div>
                </div>

                <div class="image-thumbnails">
                    @if(isset($produto) && $produto->imagens_extras)
                        @foreach($produto->imagens_extras as $extra)
                            <div class="thumbnail-box" style="border: none;">
                                <img 
                                    src="{{ $imagemProdutoUrl($extra) }}" 
                                    onerror="this.onerror=null; this.src='{{ $productPlaceholder }}';"
                                    style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;"
                                >
                            </div>
                        @endforeach
                    @endif

                    @if(!isset($produto) || !$produto->imagens_extras || count($produto->imagens_extras) < 4)
                        <div class="thumbnail-box dotted-box" style="width: 120px;">
                            <input type="file" id="imagens_extras" name="imagens_extras[]" accept="image/*" multiple>
                            <span class="material-symbols-outlined">library_add</span>
                            <span>{{ __('messages.add_images') }}</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-card">
                <h3>{{ __('messages.categories') }}</h3>
                
                <div class="form-group">
                    <label for="categoria">{{ __('messages.product_category') }}</label>
                    <select id="categoria" name="categoria" required>
                        <option value="" disabled {{ !isset($produto) ? 'selected' : '' }}>{{ __('messages.select_product_placeholder') }}</option>
                        <option value="acessorios" {{ (old('categoria', $produto->categoria ?? '') == 'acessorios') ? 'selected' : '' }}>{{ __('messages.cat_accessories') }}</option>
                        <option value="cordas" {{ (old('categoria', $produto->categoria ?? '') == 'cordas') ? 'selected' : '' }}>{{ __('messages.cat_strings') }}</option>
                        <option value="amplificadores" {{ (old('categoria', $produto->categoria ?? '') == 'amplificadores') ? 'selected' : '' }}>{{ __('messages.cat_amplifiers') }}</option>
                        <option value="pedais" {{ (old('categoria', $produto->categoria ?? '') == 'pedais') ? 'selected' : '' }}>{{ __('messages.cat_pedals') }}</option>
                        <option value="percussao" {{ (old('categoria', $produto->categoria ?? '') == 'percussao') ? 'selected' : '' }}>{{ __('messages.cat_percussion') }}</option>
                        <option value="audio" {{ (old('categoria', $produto->categoria ?? '') == 'audio') ? 'selected' : '' }}>{{ __('messages.cat_audio') }}</option>
                        <option value="sopro" {{ (old('categoria', $produto->categoria ?? '') == 'sopro') ? 'selected' : '' }}>{{ __('messages.cat_wind') }}</option>
                        <option value="teclas" {{ (old('categoria', $produto->categoria ?? '') == 'teclas') ? 'selected' : '' }}>{{ __('messages.cat_keys') }}</option>
                    </select>
                </div>
            </div>

            <div class="form-card">
                <h3>{{ __('messages.select_color') }}</h3>
                
                <div class="color-picker-group">
                    <input type="checkbox" id="cor_verde" name="cores[]" value="verde" {{ in_array('verde', old('cores', $produto->cores ?? [])) ? 'checked' : '' }}>
                    <label for="cor_verde" class="color-swatch" style="background-color: #dcedc8;"></label>

                    <input type="checkbox" id="cor_rosa" name="cores[]" value="rosa" {{ in_array('rosa', old('cores', $produto->cores ?? [])) ? 'checked' : '' }}>
                    <label for="cor_rosa" class="color-swatch" style="background-color: #f8bbd0;"></label>

                    <input type="checkbox" id="cor_azul" name="cores[]" value="azul" {{ in_array('azul', old('cores', $produto->cores ?? [])) ? 'checked' : '' }}>
                    <label for="cor_azul" class="color-swatch" style="background-color: #cfd8dc;"></label>

                    <input type="checkbox" id="cor_amarelo" name="cores[]" value="amarelo" {{ in_array('amarelo', old('cores', $produto->cores ?? [])) ? 'checked' : '' }}>
                    <label for="cor_amarelo" class="color-swatch" style="background-color: #f0f4c3;"></label>

                    <input type="checkbox" id="cor_preto" name="cores[]" value="preto" {{ in_array('preto', old('cores', $produto->cores ?? [])) ? 'checked' : '' }}>
                    <label for="cor_preto" class="color-swatch" style="background-color: #37474f;"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions-footer">
        <a href="/admin/produtos" class="btn-cancel">{{ __('messages.cancel') }}</a>
        <button type="submit" class="btn-save">{{ __('messages.save') }}</button>
    </div>
</form>
@endsection