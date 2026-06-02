@extends('layouts.admin')

@section('breadcrumb', isset($produto) ? 'EDITAR PRODUTO' : 'ADICIONAR PRODUTO')

@section('content')
<div class="admin-page-header">
    <h2>{{ isset($produto) ? 'Editar produto' : 'Adicionar novo produto' }}</h2>
</div>

<form action="{{ isset($produto) ? '/admin/produtos/' . $produto->id : '/admin/produtos' }}" method="POST" enctype="multipart/form-data" class="product-create-form">
    @csrf
    @if(isset($produto))
        @method('PUT')
    @endif
    
    <div class="form-layout-grid">
        <div class="form-left-column">
            <div class="form-card">
                <h3>Detalhes básicos</h3>
                
                <div class="form-group">
                    <label for="nome">Nome do Produto</label>
                    <input type="text" id="nome" name="nome" value="{{ old('nome', $produto->nome ?? '') }}" placeholder="Ex: Guitarra Stratocaster" required>
                </div>

                <div class="form-group">
                    <label for="marca">Marca do Produto</label>
                    <input type="text" id="marca" name="marca" value="{{ old('marca', $produto->marca ?? '') }}" placeholder="Ex: Fender" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição do Produto</label>
                    <textarea id="descricao" name="descricao" rows="5" placeholder="Descreva os detalhes do produto..." required>{{ old('descricao', $produto->descricao ?? '') }}</textarea>
                </div>
            </div>

            <div class="form-card">
                <h3>Precificação</h3>
                
                <div class="form-group">
                    <label for="preco">Preço do produto</label>
                    <div class="input-with-prefix">
                        <span class="prefix">R$</span>
                        <input type="text" id="preco" name="preco" value="{{ old('preco', isset($produto) ? number_format($produto->preco, 2, ',', '.') : '') }}" placeholder="0,00" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="desconto">Desconto do produto <span class="optional">(Opcional)</span></label>
                        <div class="input-with-prefix">
                            <span class="prefix">R$</span>
                            <input type="text" id="desconto" name="desconto" value="{{ old('desconto', (isset($produto) && $produto->desconto) ? number_format($produto->desconto, 2, ',', '.') : '') }}" placeholder="0,00">
                        </div>
                    </div>
                    <div class="form-group half-width align-bottom">
                        <div class="calculated-price">
                            Vendido = R$ <span id="preco-final">{{ isset($produto) ? number_format(($produto->preco - ($produto->desconto ?? 0)), 2, ',', '.') : '0,00' }}</span>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="data_inicio">Início da Expiração</label>
                        <input type="date" id="data_inicio" name="data_inicio" value="{{ old('data_inicio', $produto->data_inicio ?? '') }}">
                    </div>
                    <div class="form-group half-width">
                        <label for="data_fim">Fim da Expiração</label>
                        <input type="date" id="data_fim" name="data_fim" value="{{ old('data_fim', $produto->data_fim ?? '') }}">
                    </div>
                </div>
            </div>

            <div class="form-card">
                <h3>Inventário</h3>
                
                <div class="form-row">
                    <div class="form-group half-width">
                        <label for="quantidade">Quantidade em estoque</label>
                        <input type="number" id="quantidade" name="quantidade" value="{{ old('quantidade', $produto->quantidade ?? '') }}" min="0" placeholder="0" required>
                    </div>
                    <div class="form-group half-width">
                        <label for="status">Status de estoque</label>
                        <select id="status" name="status" required>
                            <option value="em_estoque" {{ (old('status', $produto->status ?? '') == 'em_estoque') ? 'selected' : '' }}>Em estoque</option>
                            <option value="fora_de_estoque" {{ (old('status', $produto->status ?? '') == 'fora_de_estoque') ? 'selected' : '' }}>Fora de estoque</option>
                            <option value="sob_encomenda" {{ (old('status', $produto->status ?? '') == 'sob_encomenda') ? 'selected' : '' }}>Sob encomenda</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-right-column">
            
            <div class="form-card">
                <h3>Upload de Mídias do produto</h3>
                
                <div class="image-upload-area">
                    <input type="file" id="imagem_principal" name="imagem_principal" accept="image/*" {{ isset($produto) ? '' : 'required' }}>
                    <div class="upload-placeholder">
                        @if(isset($produto) && $produto->imagem_principal)
                            <img src="{{ asset('storage/' . $produto->imagem_principal) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                        @else
                            <span class="material-symbols-outlined">add_photo_alternate</span>
                            <p>Clique ou arraste a mídia principal aqui</p>
                        @endif
                    </div>
                </div>

                <div class="image-thumbnails">
                    @if(isset($produto) && $produto->imagens_extras)
                        @foreach($produto->imagens_extras as $extra)
                            <div class="thumbnail-box" style="border: none;">
                                <img src="{{ asset('storage/' . $extra) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                            </div>
                        @endforeach
                    @endif

                    @if(!isset($produto) || !$produto->imagens_extras || count($produto->imagens_extras) < 4)
                        <div class="thumbnail-box dotted-box" style="width: 120px;">
                            <input type="file" id="imagens_extras" name="imagens_extras[]" accept="image/*" multiple>
                            <span class="material-symbols-outlined">library_add</span>
                            <span>Add imagens</span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-card">
                <h3>Categorias</h3>
                
                <div class="form-group">
                    <label for="categoria">Categoria do produto</label>
                    <select id="categoria" name="categoria" required>
                        <option value="" disabled {{ !isset($produto) ? 'selected' : '' }}>selecione seu produto</option>
                        <option value="acessorios" {{ (old('categoria', $produto->categoria ?? '') == 'acessorios') ? 'selected' : '' }}>Acessórios</option>
                        <option value="cordas" {{ (old('categoria', $produto->categoria ?? '') == 'cordas') ? 'selected' : '' }}>Cordas</option>
                        <option value="amplificadores" {{ (old('categoria', $produto->categoria ?? '') == 'amplificadores') ? 'selected' : '' }}>Amplificadores</option>
                        <option value="pedais" {{ (old('categoria', $produto->categoria ?? '') == 'pedais') ? 'selected' : '' }}>Pedais & Pedaleiras</option>
                        <option value="percussao" {{ (old('categoria', $produto->categoria ?? '') == 'percussao') ? 'selected' : '' }}>Percussão</option>
                        <option value="audio" {{ (old('categoria', $produto->categoria ?? '') == 'audio') ? 'selected' : '' }}>Áudio e Tecnologia</option>
                        <option value="sopro" {{ (old('categoria', $produto->categoria ?? '') == 'sopro') ? 'selected' : '' }}>Sopro</option>
                        <option value="teclas" {{ (old('categoria', $produto->categoria ?? '') == 'teclas') ? 'selected' : '' }}>Teclas</option>
                    </select>
                </div>
            </div>

            <div class="form-card">
                <h3>Selecionar cor</h3>
                
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
        <a href="/admin/produtos" class="btn-cancel">Cancelar</a>
        <button type="submit" class="btn-save">Salvar</button>
    </div>
</form>
@endsection